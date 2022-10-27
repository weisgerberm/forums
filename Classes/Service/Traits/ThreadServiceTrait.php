<?php

namespace Weisgerber\Forums\Service\Traits;

use Weisgerber\Forums\Service\ThreadService;

trait ThreadServiceTrait
{
    protected ?ThreadService $threadService = null;

    /**
     * @param \Weisgerber\Forums\Service\ThreadService|null $threadService
     */
    public function injectThreadService (?ThreadService $threadService): void
    {
        $this->threadService = $threadService;
    }
}
