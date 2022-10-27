<?php

namespace Weisgerber\Forums\Service\Traits;

use Weisgerber\Forums\Service\PageService;

trait PageServiceTrait
{
    protected ?PageService $pageService = null;

    /**
     * @param \Weisgerber\Forums\Service\PageService|null $pageService
     */
    public function injectPageService (?PageService $pageService): void
    {
        $this->pageService = $pageService;
    }
}
