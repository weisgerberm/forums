<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Controller;

use GeorgRinger\News\Domain\Model\News;
use GeorgRinger\News\Domain\Repository\NewsRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use Weisgerber\DarfIchMit\Controller\AbstractBackendController;
use Weisgerber\DarfIchMit\Domain\Model\Xp;
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

        return $this->htmlResponse($this->createBackendView());
    }

    /**
     * Create a thread for news-records
     */
    public function newsAction(): ResponseInterface
    {
        /** @var NewsRepository $newsRepository */
        $newsRepository = GeneralUtility::makeInstance(NewsRepository::class);
        /** @var Typo3QuerySettings $querySettings */
        $querySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(false);
        $newsRepository->setDefaultQuerySettings($querySettings);
        $news = $newsRepository->findAll();

        $this->view->assign('records', $news);

        return $this->htmlResponse($this->createBackendView());
    }


    /**
     * Creates a thread based on a news record
     *
     * @param News $news
     */
    public function createNewsThreadAction(News $news): ResponseInterface
    {
        $frontendUser = $this->frontendUserRepository->findByUid(1);

        /** @var Thread $newThread */
        $newThread = GeneralUtility::makeInstance(Thread::class);
        $newThread->setPid(6106); // Im Unterforum "Unsere Artikel"
        $newThread->setTitle($news->getTitle());

        /** @var Post $post */
        $post = GeneralUtility::makeInstance(Post::class);
        $post->setPid($newThread->getPid());
        $post->setFrontenduser($frontendUser);

        /** @var PostContent $postContent */
        $postContent = GeneralUtility::makeInstance(PostContent::class);
        $postContent->setPid($newThread->getPid());
        $postContent->setPost($post);
        $postContent->setDescription('Hier kann zu unserem Artikel '.$news->getTitle().' diskutiert werden');

        $post->addPostContent($postContent);

        $newThread->addPost($post);

        $this->threadRepository->add($newThread);


        DimUtility::persistAll();
        $news->setImportId($newThread->getUid());
        $news->setImportSource('forums');

        /** @var NewsRepository $newsRepository */
        $newsRepository = GeneralUtility::makeInstance(NewsRepository::class);
        $newsRepository->update($news);


        $newThread->setPathSegment($this->slugService->getSlug($newThread->jsonSerialize(), Thread::TABLE_NAME));
        $this->threadRepository->update($newThread);

        DimUtility::persistAll();
        return $this->redirect('news');
    }
}
