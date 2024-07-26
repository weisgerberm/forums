<?php

namespace Weisgerber\Forums\Service;

use Weisgerber\Forums\Domain\Model\Page;
use Weisgerber\Forums\Traits\{PageRepositoryTrait,PostRepositoryTrait};

class PageService
{
    use PageRepositoryTrait;
    use PostRepositoryTrait;

    /**
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function getSubforumsAndPrefillThem(): array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
    {
        // fetching the category-pages. Afterwards we need to loop them to get the subforums
        $categoryPages = $this->pageRepository->findAll();

        /** @var \Weisgerber\Forums\Domain\Model\Page $categoryPage */
        foreach ($categoryPages as $categoryPage){
            $categoryPage->setChildren($this->pageRepository->findByPid($categoryPage->getUid()));

            /** @var Page $categoryPageChild */
            foreach ($categoryPage->getChildren() as $categoryPageChild){
                $categoryPageChild->setCachedPostCounter($this->postRepository->countPosts($categoryPageChild->getUid()));
                $categoryPageChild->setCachedLatestPost($this->postRepository->findLatest($categoryPageChild->getUid()));
            }
        }
        return $categoryPages;
    }
    /**
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function getSubforumAndPrefillThem(int $categoryPage): Page
    {
        $categoryPage = $this->pageRepository->findByUid($categoryPage);
        $categoryPage->setChildren($this->pageRepository->findByPid($categoryPage->getUid()));

        /** @var Page $categoryPageChild */
        foreach ($categoryPage->getChildren() as $categoryPageChild){
            $categoryPageChild->setCachedPostCounter($this->postRepository->countPosts($categoryPageChild->getUid()));
            $categoryPageChild->setCachedLatestPost($this->postRepository->findLatest($categoryPageChild->getUid()));
        }

        return $categoryPage;
    }
}
