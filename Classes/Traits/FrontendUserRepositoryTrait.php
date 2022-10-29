<?php

namespace Weisgerber\Forums\Traits;

trait FrontendUserRepositoryTrait
{
    /**
     * @var \Weisgerber\Forums\Domain\Repository\FrontendUserRepository
     */
    protected \Weisgerber\Forums\Domain\Repository\FrontendUserRepository $frontendUserRepository;

    /**
     * @param \Weisgerber\Forums\Domain\Repository\FrontendUserRepository $frontendUserRepository
     */
    public function injectFrontendUserRepository(\Weisgerber\Forums\Domain\Repository\FrontendUserRepository $frontendUserRepository): void
    {
        $this->frontendUserRepository = $frontendUserRepository;
    }

}
