<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Seo;

use TYPO3\CMS\Core\PageTitle\AbstractPageTitleProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Weisgerber\Forums\Domain\Model\Thread;

/**
 * Generate page title based on properties of the thread model (inspired by EXT:news)
 */
class ThreadTitleProvider extends AbstractPageTitleProvider
{

    /**
     * @param Thread $thread
     * @param array $configuration
     */
    public function setTitleByThread(Thread $thread, array $configuration = []): void
    {
        $this->title = $thread->getHeadline();
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
