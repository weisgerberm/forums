<?php

namespace Weisgerber\Forums\Service\Traits;

trait UriServiceTrait
{
    /**
     * @var \Weisgerber\Forums\Service\UriService
     */
    protected \Weisgerber\Forums\Service\UriService $uriService;

    /**
     * @param \Weisgerber\Forums\Service\UriService $uriService
     */
    public function injectUriService(\Weisgerber\Forums\Service\UriService $uriService): void
    {
        $this->uriService = $uriService;
    }
}
