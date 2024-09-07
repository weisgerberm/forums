<?php

namespace Weisgerber\Forums\Service;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use Weisgerber\DarfIchMit\Domain\Model\FrontendUser;
use Weisgerber\Forums\Traits\PostRepositoryTrait;

class PostService extends AbstractService
{
    use PostRepositoryTrait;

    /**
     * Checks whether the frontend user is allowed to post anything at all and queries all his posts within the last minute and the last hour
     *
     * @param FrontendUser $frontendUser
     * @return bool
     */
    public function rateLimiter(FrontendUser $frontendUser): bool
    {
        $this->configurationService->init('forums');

        $postsLastMinute    = $this->postRepository->countCreatedAfter($frontendUser, time() - 60);
        $postsLastHour      = $this->postRepository->countCreatedAfter($frontendUser, time() - 3600);

        if (!$frontendUser->getTxFemanagerConfirmedbyuser()) {
            if ($postsLastHour >= $this->getSettings()['defaults']['unconfirmedEmailPostsPerHour']) {
                return false;
            }
        } else {
            if ($postsLastHour >= $this->getSettings()['defaults']['postsPerHour']) {
                return false;
            }
        }

        if ($postsLastMinute >= $this->getSettings()['defaults']['postsPerMinute']) {
            return false;
        }
        return true;
    }
}
