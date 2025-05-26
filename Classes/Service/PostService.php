<?php

namespace Weisgerber\Forums\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Weisgerber\DarfIchMit\Domain\Model\FrontendUser;
use Weisgerber\DarfIchMit\Utility\DimUtility;
use Weisgerber\DarfIchMitMail\Domain\Model\Mail;
use Weisgerber\DarfIchMitMail\Domain\Repository\MailRepository;
use Weisgerber\DarfIchMitMail\Service\MailService;
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
     *
     * @param RequestInterface $request*/
	public function notifyAboutNewPost(Thread $thread, Post $newPost, ?FrontendUser $frontendUser, RequestInterface $request): void
    {
        $mailRepository = GeneralUtility::makeInstance(MailRepository::class);
        /** @var MailService $mailService */
        $mailService = GeneralUtility::makeInstance(MailService::class);

        /** @var FrontendUser $subscriber */
        foreach ($thread->getSubscribers() as $subscriber) {
            // When the current user of the post is a subscriber we'll skip the notification. Also checking whether the user allows to receive emails
            if($frontendUser !== $subscriber && $subscriber->getAllowEmails()) {
                $mail = $this->getNotificationEmail($thread, $newPost, $subscriber);
                $mailRepository->add($mail);
                DimUtility::persistAll();
            }
        }
	}

    private function getNotificationEmail(Thread $thread, Post $newPost, ?FrontendUser $frontendUser): Mail
    {
        /** @var Mail $mail */
        $mail = GeneralUtility::makeInstance(Mail::class);
        $mail->setPid(637);
        $mail->setSubject(LocalizationUtility::translate('email_subject_new_post_notification', 'forums', [$thread->getTitle()]));
        $mail->setAddress($frontendUser->getEmail());
        $mail->setUidForeign($thread->getUid());
        $mail->setTablename(Thread::TABLE_NAME);
        $mail->setSerializedVariables(json_encode([
            'uid' => $frontendUser->getUid(),
            'username' => $frontendUser->getUsername(),
            'page' => $thread->getPid(),
        ]));

        $mail->setTemplate("Forums/NewPostNotification");

        return $mail;
    }
}
