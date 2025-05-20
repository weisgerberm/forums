<?php

namespace Weisgerber\Forums\Service;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use Weisgerber\DarfIchMit\Domain\Model\FrontendUser;
use Weisgerber\Forums\Domain\Model\Post;
use Weisgerber\Forums\Domain\Model\Thread;
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
        $this->configurationService->initSettings('forums');

        $postsLastMinute    = $this->postRepository->countCreatedAfter($frontendUser, time() - 60);
        $postsLastHour      = $this->postRepository->countCreatedAfter($frontendUser, time() - 3600);

        if (is_null($frontendUser->getConfirmedByUser())) {
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

    /**
     * Notifies all subscribers of a thread except those who generally reject mails by their profile settings
     */
	public function notifyAboutNewPost(Thread $thread, Post $newPost, ?FrontendUser $frontendUser): void
    {
        /** @var FrontendUser $subscriber */
        foreach ($thread->getSubscribers() as $subscriber) {
            // When the current user of the post is a subscriber we'll skip the notification. Also checking whether the user allows to receive emails
            if(!$frontendUser === $subscriber && $subscriber->getAllowEmails()) {

            }
        }
	}
}
