<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\Pagination\ArrayPaginator;
use TYPO3\CMS\Core\Pagination\SlidingWindowPagination;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use Weisgerber\DarfIchMit\Domain\Model\Activity;
use Weisgerber\DarfIchMit\Domain\Model\DTO\LinkBuilderDTO;
use Weisgerber\DarfIchMit\Domain\Model\Xp;
use Weisgerber\DarfIchMit\Traits\ActivityServiceTrait;
use Weisgerber\DarfIchMit\Traits\FrontendUserServiceTrait;
use Weisgerber\DarfIchMit\Traits\SlugServiceTrait;
use Weisgerber\DarfIchMit\Traits\XpServiceTrait;
use Weisgerber\DarfIchMit\Utility\DimUtility;
use Weisgerber\Forums\Domain\Model\Post;
use Weisgerber\Forums\Domain\Model\Thread;
use Weisgerber\Forums\Service\UriService;
use Weisgerber\Forums\Traits\{ThreadRepositoryTrait, ThreadServiceTrait, UriServiceTrait};

/**
 * This file is part of the "forums" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Mark Weisgerber <mark.weisgerber@outlook.de>
 */

/**
 * ThreadController
 */
class ThreadController extends \Weisgerber\DarfIchMit\Controller\AbstractController
{
    use SlugServiceTrait;
    use ThreadRepositoryTrait;
    use FrontendUserServiceTrait;
    use ThreadServiceTrait;
    use UriServiceTrait;
    use XpServiceTrait;
    use ActivityServiceTrait;

    /**
     * action list
     *
     * @param int $currentPage
     * @return ResponseInterface
     */
    public function listAction(int $currentPage = 1): ResponseInterface
    {
        $threads = $this->threadRepository->findAll();

        /** @var \TYPO3\CMS\Extbase\Pagination\QueryResultPaginator $paginator */
        $paginator = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Pagination\QueryResultPaginator::class, $threads,$currentPage, 10);
        /** @var \TYPO3\CMS\Core\Pagination\SimplePagination $pagination */
        $pagination = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Pagination\SimplePagination::class,$paginator);
        $this->view->assignMultiple(
            [
                'threads' => $paginator->getPaginatedItems(),
                'pagination' => $pagination
            ]
        );
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param Thread    $thread
     * @param int       $currentPage
     * @param Post|null $quotePost
     * @param int      $jumpToLatest
     * @return ResponseInterface
     * @throws AspectNotFoundException
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     */
    #[IgnoreValidation(['argumentName' => 'thread'])]
    #[IgnoreValidation(['argumentName' => 'quotePost'])]
    public function showAction(Thread $thread, int $currentPage = 1, ?Post $quotePost = null, int $jumpToLatest = 0): ResponseInterface
    {
        // Wenn der Benutzer zum neusten Beitrag springen will, dann schauen wir nach, welche Seite er dafür braucht und machen dafür einen redirect
        if($jumpToLatest && $currentPage === 1){
            $returnPageNo = ceil(count($thread->getPosts()) / (int)$this->settings['defaults']['threadItemsPerPage']);
            if($returnPageNo>1){
                return $this->redirect('show', null, null, ['thread' => $thread, 'currentPage' => $returnPageNo, 'jumpToLatest' => $jumpToLatest, 'quotePost' => $quotePost]);
            }
        }

        $thread->setCachedCounterViews($thread->getCachedCounterViews() + 1);
        $this->threadRepository->update($thread);
        $this->fetchFeUser();

        // Normal numeric pagination
        $paginator = new ArrayPaginator(
            $thread->getPosts()->toArray(),
            $currentPage,
            (int) $this->settings['defaults']['threadItemsPerPage']
        );

        $pagination = new SlidingWindowPagination(
            $paginator,
            15
        );



        $this->view->assignMultiple([
            'thread' => $thread,
            'jumpToLatest' => $jumpToLatest,
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
     * action edit
     *
     * @param Thread $thread
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("thread")
     * @return ResponseInterface
     */
    public function editAction(Thread $thread): ResponseInterface
    {
        $this->view->assign('thread', $thread);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param Thread $thread
     */
    public function updateAction(Thread $thread)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->threadRepository->update($thread);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param Thread $thread
     */
    public function deleteAction(Thread $thread)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->threadRepository->remove($thread);
        $this->redirect('list');
    }

    /**
     * action lock
     *
     * @return ResponseInterface
     */
    public function lockAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action rss
     *
     * @return ResponseInterface
     */
    public function rssAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }
}
