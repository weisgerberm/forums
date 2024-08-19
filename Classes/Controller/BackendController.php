<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Controller;

use GeorgRinger\News\Domain\Repository\NewsRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use Weisgerber\DarfIchMit\Controller\AbstractBackendController;
use Weisgerber\DarfIchMit\Traits\ModuleTemplateServiceTrait;

class BackendController extends AbstractBackendController
{
    use ModuleTemplateServiceTrait;

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
}
