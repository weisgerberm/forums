<?php

namespace Weisgerber\Forums\Service;

use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Weisgerber\Forums\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Core\Session\UserSessionManager;
use Weisgerber\Forums\Traits\FrontendUserRepositoryTrait;

class FrontendUserService
{
    use FrontendUserRepositoryTrait;
    /**
     * Cached variable, don't call it directly. Use getLoggedInUser() instead!
     *
     * @var \Weisgerber\Forums\Domain\Model\FrontendUser
     */
    protected $currentLoggedInUser = null;

    /**
     * get current logged in User
     *
     * @return \Weisgerber\Forums\Domain\Model\FrontendUser|null
     * @throws \TYPO3\CMS\Core\Context\Exception\AspectNotFoundException
     */
    public function getLoggedInUser(): ?\Weisgerber\Forums\Domain\Model\FrontendUser
    {
        if(!is_null($this->currentLoggedInUser)) {
            return $this->currentLoggedInUser;
        }

        $context = GeneralUtility::makeInstance(Context::class);
        $userId = $context->getPropertyFromAspect('frontend.user', 'id');
        return $this->frontendUserRepository->findByUid($userId);
    }
}
