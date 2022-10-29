<?php

namespace Weisgerber\Forums\Traits;

use Weisgerber\Forums\Service\FrontendUserService;

trait FrontendUserServiceTrait
{
    protected ?FrontendUserService $frontendUserService = null;

    /**
     * @param \Weisgerber\Forums\Service\FrontendUserService|null $frontendUserService
     */
    public function injectFrontendUserService(?FrontendUserService $frontendUserService): void
    {
        $this->frontendUserService = $frontendUserService;
    }


}
