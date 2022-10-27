<?php

namespace Weisgerber\Forums\Repository\Traits;


trait PageRepositoryTrait
{
    protected \Weisgerber\Forums\Domain\Repository\PageRepository $pageRepository;

    /**
     * @param \Weisgerber\Forums\Domain\Repository\PageRepository $pageRepository
     */
    public function injectPageRepository(\Weisgerber\Forums\Domain\Repository\PageRepository $pageRepository): void
    {
        $this->pageRepository = $pageRepository;
    }
}
