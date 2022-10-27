<?php

namespace Weisgerber\Forums\Service\Traits;

use Weisgerber\Forums\Service\SlugService;

trait SlugServiceTrait
{
    protected ?SlugService $slugService = null;

    /**
     * @param \Weisgerber\Forums\Service\SlugService|null $slugService
     */
    public function injectSlugService (?SlugService $slugService): void
    {
        $this->slugService = $slugService;
    }
}
