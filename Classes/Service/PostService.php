<?php

namespace Weisgerber\Forums\Service;

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
        $postsLastMinute = $this->postRepository->count(['crdate' => time() - 60]);
        $postsLastHour = $this->postRepository->count(['crdate' => time() - 3600]);

        if ($frontendUser->getEmailConfirmed()) {
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
