<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Controller;

use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\Pagination\{ArrayPaginator, SlidingWindowPagination};
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;
use TYPO3\CMS\Extbase\Persistence\Exception\{IllegalObjectTypeException, UnknownObjectException};
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Weisgerber\DarfIchMit\Domain\Model\{Activity, DTO\LinkBuilderDTO, Xp};
use Weisgerber\DarfIchMit\Traits\{ActivityServiceTrait,
    FrontendUserServiceTrait,
    SchemaServiceTrait,
    SlugServiceTrait,
    XpServiceTrait};
use Weisgerber\DarfIchMit\Utility\{DimUtility, MathUtility};
use Weisgerber\Forums\Domain\Model\{Post, Thread};
use Weisgerber\Forums\Domain\Repository\PostRepository;
use Weisgerber\Forums\Traits\{ThreadRepositoryTrait, ThreadServiceTrait, UriServiceTrait};

class ThreadController extends \Weisgerber\DarfIchMit\Controller\AbstractController
{
    use SlugServiceTrait;
    use ThreadRepositoryTrait;
    use FrontendUserServiceTrait;
    use ThreadServiceTrait;
    use UriServiceTrait;
    use XpServiceTrait;
    use ActivityServiceTrait;
    use SchemaServiceTrait;

    /**
     * action list
     *
     * @param int $currentPage
     * @return ResponseInterface
     */
    public function listAction(int $currentPage = 1): ResponseInterface
    {
        $threads = $this->threadRepository->findAll();

        $frontendUser = $this->fetchFeUser();
        // Erstmal nur global erlauben
        $threadsPerPage = 10;
//        $threadsPerPage = ($frontendUser) ? $frontendUser->getThreadsPerPage() : 10;

        /** @var \TYPO3\CMS\Extbase\Pagination\QueryResultPaginator $paginator */
        $paginator = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Pagination\QueryResultPaginator::class, $threads,$currentPage, $threadsPerPage);
        /** @var \TYPO3\CMS\Core\Pagination\SlidingWindowPagination $pagination */
        $pagination = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Pagination\SlidingWindowPagination::class,$paginator, 10);


        $this->view->assignMultiple(
            [
                'threads' => $paginator->getPaginatedItems(),
                'pagination' => $pagination
            ]
        );
        return $this->htmlResponse();
    }

    /**
     * Shows a thread and its related posts
     * Achtung: Schema JSON+LD ist hier nicht gewünscht, das empfiehlt selbst google selber https://developers.google.com/search/docs/appearance/structured-data/discussion-forum?hl=de#mikrodaten
     *
     * @param Thread    $thread
     * @param int       $currentPage
     * @param Post|null $quotePost
     * @param int       $jumpTo
     * @return ResponseInterface
     * @throws AspectNotFoundException
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     */
    #[IgnoreValidation(['argumentName' => 'thread'])]
    #[IgnoreValidation(['argumentName' => 'quotePost'])]
    public function showAction(Thread $thread, int $currentPage = 1, ?Post $quotePost = null, int $jumpTo = 0): ResponseInterface
    {
        $returnPageNo = 0;

        // Wenn der Benutzer zum neusten Beitrag springen will, dann schauen wir nach, welche Seite er dafür braucht und machen dafür einen redirect
        if($jumpTo === 1 && $currentPage === 1){
            $returnPageNo = MathUtility::getPageNo(count($thread->getPosts()), (int)$this->settings['defaults']['threadItemsPerPage']);
        }else if($jumpTo > 1){
            // Wenn größer als 1, dann suchen wir eine Post-UID
            /** @var PostRepository $postRepository */
            $postRepository = GeneralUtility::makeInstance(PostRepository::class);
            $targetPost = $postRepository->findByUid($jumpTo);
            if($targetPost){
                $returnPageNo = MathUtility::getPageNo($thread->getPosts()->getPosition($targetPost), (int)$this->settings['defaults']['threadItemsPerPage']);
            }
        }

        if($returnPageNo>1){
            return $this->redirect('show', null, null, ['thread' => $thread, 'currentPage' => $returnPageNo, 'jumpTo' => $jumpTo, 'quotePost' => $quotePost]);
        }

        // Library CrawlerDetect https://github.com/JayBizzle/Crawler-Detect wird verwendet, dass Bots den Counter
        // nicht verfälschen.
        $crawlerDetect = new CrawlerDetect();

        // Check the user agent of the current 'visitor'
        if(!$crawlerDetect->isCrawler()) {
            $thread->setCachedCounterViews($thread->getCachedCounterViews() + 1);
            $this->threadRepository->update($thread);
        }


//        $postsPerPage = ($frontendUser) ? $frontendUser->getPostsPerPage() : (int) $this->settings['defaults']['threadItemsPerPage'];
        // Erstmal nur global erlauben
        $postsPerPage = (int) $this->settings['defaults']['threadItemsPerPage'];

        // Normal numeric pagination
        $paginator = new ArrayPaginator(
            $thread->getPosts()->toArray(),
            $currentPage,
            $postsPerPage
        );

        $pagination = new SlidingWindowPagination(
            $paginator,
            15
        );


        $this->view->assignMultiple([
            'thread' => $thread,
            'jumpTo' => $jumpTo,
            'currentPage' => $currentPage,
            'pagination' => $pagination,
            'paginator' => $paginator,
            'quotePost' => $quotePost,
        ]);
        return $this->htmlResponse();
    }

    /**
     * action new
     *
     * @return ResponseInterface
     */
    public function newAction(): ResponseInterface
    {
        $frontendUser = $this->fetchFeUser();
        if($frontendUser === null){
            \nn\t3::Http()->redirect( $this->settings['noPermission'] );
        }

        return $this->htmlResponse();
    }

    /**
     * action create
     *
     * @param Thread $newThread
     */
    public function createAction(Thread $newThread): ResponseInterface
    {
        $frontendUser = $this->fetchFeUser();
        if($frontendUser === null){
            \nn\t3::Http()->redirect( $this->settings['noPermission'] );
        }

        $this->threadRepository->add($newThread);

        DimUtility::persistAll();
        /** @var Thread $record */

        $this->threadService->postProcessing($newThread);

        $newThread->setPathSegment($this->slugService->getSlug($newThread->jsonSerialize(), Thread::TABLE_NAME));
        $this->threadRepository->update($newThread);

        // XP gutschreiben
        $this->xpService->gain($frontendUser, 3, Xp::TYPE_FORUM_THREAD);

        // Sodass die URL schon korrekt aufgelöst werden kann bei der Weiterleitung
        DimUtility::persistAll();
        $this->activityService->addActivity(
            $newThread->getTitle(),
            Activity::TYPE_FORUM_THREAD,
            (new LinkBuilderDTO(Activity::TYPE_FORUM_THREAD, $newThread->getUid()))->build()
        );
        return $this->redirect('show', null, null, ['thread' => $newThread]);
    }

    /**
     * Subscribe the current logged in user to the given thread
     *
     * @param Thread $thread
     * @return ResponseInterface
     * @throws AspectNotFoundException
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     */
    #[IgnoreValidation(['argumentName' => 'thread'])]
    public function subscribeAction(Thread $thread): ResponseInterface
    {
        $frontendUser = $this->fetchFeUser();
        if($frontendUser === null){
            \nn\t3::Http()->redirect( $this->settings['noPermission'] );
        }

        if($frontendUser->hasThreadSubscription($thread)){
            // Falls der Benutzer bereits Abonnent ist geben wir lediglich eine Nachricht aus und unternehmen sonst nichts
            \nn\t3::Message()->WARNING(
                LocalizationUtility::translate('LLL:EXT:darf_ich_mit/Resources/Private/Language/locallang.xlf:that-didnt-work', 'EXT:darf_ich_mit'),
                LocalizationUtility::translate('LLL:EXT:forums/Resources/Private/Language/locallang.xlf:already-subscribed-thread', 'EXT:forums'));
        }else{
            // Der Benutzer hat noch kein Abonnement und das legen wir nun an
            \nn\t3::Message()->OK(
                LocalizationUtility::translate('LLL:EXT:darf_ich_mit_social/Resources/Private/Language/locallang.xlf:super', 'EXT:darf_ich_mit_social'),
                LocalizationUtility::translate('LLL:EXT:forums/Resources/Private/Language/locallang.xlf:subscribed-thread', 'EXT:forums'));
            $thread->addSubscriber($frontendUser);
            $this->threadRepository->update($thread);
        }

        return $this->redirect('show', null, null, ['thread' => $thread]);
    }
}
