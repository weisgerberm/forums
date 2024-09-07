<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Controller;

use Weisgerber\DarfIchMit\Domain\Repository\NewsDefaultRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Context\LanguageAspect;
use TYPO3\CMS\Core\Exception\SiteNotFoundException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Weisgerber\DarfIchMit\Controller\AbstractBackendController;
use Weisgerber\DarfIchMit\Traits\FrontendUserRepositoryTrait;
use Weisgerber\DarfIchMit\Traits\ModuleTemplateServiceTrait;
use Weisgerber\DarfIchMit\Traits\SlugServiceTrait;
use Weisgerber\DarfIchMit\Utility\DimUtility;
use Weisgerber\Forums\Domain\Model\Post;
use Weisgerber\Forums\Domain\Model\PostContent;
use Weisgerber\Forums\Domain\Model\Thread;
use Weisgerber\Forums\Traits\ThreadRepositoryTrait;
use Weisgerber\Forums\Traits\ThreadServiceTrait;

class BackendController extends AbstractBackendController
{
    use ModuleTemplateServiceTrait;
    use FrontendUserRepositoryTrait;
    use SlugServiceTrait;
    use ThreadServiceTrait;
    use ThreadRepositoryTrait;

    /**
     * Backend view status
     */
    public function statusAction(): ResponseInterface
    {
        $mostActiveUsers = \nn\t3::Db()->statement( "SELECT fe_users.username,
    COUNT(tx_forums_domain_model_post.uid) AS post_count
FROM
    tx_forums_domain_model_post
        JOIN
    fe_users
    ON fe_users.uid = tx_forums_domain_model_post.frontenduser
WHERE
    tx_forums_domain_model_post.crdate > UNIX_TIMESTAMP() - 86400
GROUP BY
    tx_forums_domain_model_post.frontenduser, fe_users.username
ORDER BY
    post_count DESC;
        ");
        $hottestThreads = \nn\t3::Db()->statement( "SELECT tx_forums_domain_model_post.thread,
    tx_forums_domain_model_thread.title,
    COUNT(tx_forums_domain_model_post.uid) AS post_count
FROM
    tx_forums_domain_model_post
        JOIN
    tx_forums_domain_model_thread
    ON tx_forums_domain_model_thread.uid = tx_forums_domain_model_post.thread
WHERE
    tx_forums_domain_model_post.crdate > UNIX_TIMESTAMP() - 86400
GROUP BY
    tx_forums_domain_model_thread.title
ORDER BY
    post_count DESC;");
        $this->view->assignMultiple([
            'mostActiveUsers' => $mostActiveUsers,
            'hottestThreads' => $hottestThreads,
        ]);

        return $this->htmlResponse($this->createBackendView());
    }

    /**
     * Create a thread for news-records
     *
     * @param int $currentPage
     * @return ResponseInterface
     */
    public function newsAction(int $currentPage = 1): ResponseInterface
    {
        /** @var NewsRepository $newsRepository */
        $newsRepository = GeneralUtility::makeInstance(NewsDefaultRepository::class);
        /** @var Typo3QuerySettings $querySettings */
        $querySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
        $querySettings->setRespectSysLanguage(false);
        $querySettings->setRespectStoragePage(false);
        $newsRepository->setDefaultQuerySettings($querySettings);

        /** @var \TYPO3\CMS\Extbase\Pagination\QueryResultPaginator $paginator */
        $paginator = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Pagination\QueryResultPaginator::class, $newsRepository->findBy([], ['uid' => QueryInterface::ORDER_DESCENDING]), $currentPage, 25);
        /** @var \TYPO3\CMS\Core\Pagination\SimplePagination $pagination */
        $pagination = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Pagination\SlidingWindowPagination::class,$paginator, 10);

        $this->view->assignMultiple([
            'records' => $paginator->getPaginatedItems(),
            'languages' => \nn\t3::Environment()->getLanguages(),
            'pagination' => $pagination,
            'paginator' => $paginator,
            'currentPage' => $currentPage,
        ]);

        return $this->htmlResponse($this->createBackendView());
    }


    /**
     * Creates a thread based on a news record
     *
     * @param int $news It's not the record itself so we can control which localized record we create, otherwise it would always be the default one
     * @param int $languageUid
     * @param int $currentPage
     * @return ResponseInterface
     * @throws IllegalObjectTypeException
     * @throws SiteNotFoundException
     * @throws UnknownObjectException
     */
    public function createNewsThreadAction(int $news, int $languageUid, int $currentPage = 1): ResponseInterface
    {
        $frontendUser = $this->frontendUserRepository->findByUid(217);

        /** @var NewsRepository $newsRepository */
        $newsRepository = GeneralUtility::makeInstance(NewsDefaultRepository::class);
        /** @var Typo3QuerySettings $querySettings */
        $querySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
        $querySettings->setLanguageAspect(new LanguageAspect($languageUid, $languageUid, LanguageAspect::OVERLAYS_MIXED));
        $querySettings->setRespectStoragePage(false);
        $newsRepository->setDefaultQuerySettings($querySettings);

        /** @var News $news */
        $news = $newsRepository->findByUid($news);

        $allLanguages = \nn\t3::Environment()->getLanguages();

        /** @var Thread $newThread */
        $newThread = GeneralUtility::makeInstance(Thread::class);
        $newThread->setPid($allLanguages[$languageUid]['forumArticles']); // Im Unterforum "Unsere Artikel" der jeweiligen Sprache. Sollte vorher schon geprüft werden, ob die Sprache diesen Ordner hat
        $newThread->setTitle($news->getTitle());

        /** @var Post $post */
        $post = GeneralUtility::makeInstance(Post::class);
        $post->setPid($newThread->getPid());
        $post->setFrontenduser($frontendUser);
        $post->setAllowHtml(true);

        /** @var PostContent $postContent */
        $postContent = GeneralUtility::makeInstance(PostContent::class);
        $postContent->setPid($newThread->getPid());
        $postContent->setPost($post);
        $postContent->_rootAccess = true;
        $postContent->setDescription(
            LocalizationUtility::translate('LLL:EXT:forums/Resources/Private/Language/locallang.xlf:discuss-our-article-here', 'EXT:forums', ['<strong><a href="t3://record?identifier=tx_news&amp;uid='.$news->getUid().'" >'.$news->getTitle().'</a></strong>'], $allLanguages[$languageUid]['locale']) .
            '<p><strong>'.LocalizationUtility::translate('LLL:EXT:darf_ich_mit/Resources/Private/Language/locallang.xlf:preview', 'EXT:darf_ich_mit', null, $allLanguages[$languageUid]['locale']) . '</strong></p>' .
            '<p class="blockquote">' . $news->getTeaser() . '</p>'
        );

        $post->addPostContent($postContent);

        $newThread->addPost($post);

        $this->threadRepository->add($newThread);


        DimUtility::persistAll();
        $news->setForumsThread($newThread);

        $newsRepository->update($news);


        $newThread->setPathSegment($this->slugService->getSlug($newThread->jsonSerialize(), Thread::TABLE_NAME));
        $this->threadRepository->update($newThread);

        DimUtility::persistAll();
        return $this->redirect('news', null, null, ['currentPage' => $currentPage]);
    }
}
