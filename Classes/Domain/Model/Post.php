<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Domain\Model;


/**
 * This file is part of the "forums" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Mark Weisgerber <mark.weisgerber@outlook.de>
 */

/**
 * Post
 */
class Post extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * frontendUser
     *
     * @var \Weisgerber\Forums\Domain\Model\FrontendUser|null
     */
    protected $frontenduser = null;

    /**
     * spam
     *
     * @var bool
     */
    protected $spam = false;

    /**
     * awaitingAdminApproval
     *
     * @var bool
     */
    protected $awaitingAdminApproval = false;

    /**
     * adminComment
     *
     * @var string
     */
    protected $adminComment = '';

    /**
     * multiple PostContent Objects for history and edit mode
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PostContent>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $postContent = null;

    /**
     * likes
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PostLike>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $likes = null;

    /**
     * poll
     *
     * @var \Weisgerber\Forums\Domain\Model\Poll
     */
    protected $poll = null;

    /**
     * related thread
     *
     * @var \Weisgerber\Forums\Domain\Model\Thread
     */
    protected $thread = null;

    /**
     * Returns the spam
     *
     * @return bool
     */
    public function getSpam()
    {
        return $this->spam;
    }

    /**
     * Returns the frontendUser
     *
     * @return FrontendUser|null
     */
    public function getFrontenduser()
    {
        return $this->frontenduser;
    }

    /**
     * Sets the spam
     *
     * @param bool $spam
     * @return void
     */
    public function setSpam(bool $spam)
    {
        $this->spam = $spam;
    }

    /**
     * Returns the boolean state of spam
     *
     * @return bool
     */
    public function isSpam()
    {
        return $this->spam;
    }

    /**
     * Returns the awaitingAdminApproval
     *
     * @return bool
     */
    public function getAwaitingAdminApproval()
    {
        return $this->awaitingAdminApproval;
    }

    /**
     * Sets the awaitingAdminApproval
     *
     * @param bool $awaitingAdminApproval
     * @return void
     */
    public function setAwaitingAdminApproval(bool $awaitingAdminApproval)
    {
        $this->awaitingAdminApproval = $awaitingAdminApproval;
    }

    /**
     * Returns the boolean state of awaitingAdminApproval
     *
     * @return bool
     */
    public function isAwaitingAdminApproval()
    {
        return $this->awaitingAdminApproval;
    }

    /**
     * __construct
     */
    public function __construct()
    {

        // Do not remove the next line: It would break the functionality
        $this->initializeObject();
    }

    /**
     * Initializes all ObjectStorage properties when model is reconstructed from DB (where __construct is not called)
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    public function initializeObject()
    {
        $this->postContent = $this->postContent ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->likes = $this->likes ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a PostContent
     *
     * @param \Weisgerber\Forums\Domain\Model\PostContent $postContent
     * @return void
     */
    public function addPostContent(\Weisgerber\Forums\Domain\Model\PostContent $postContent)
    {
        $this->postContent->attach($postContent);
    }

    /**
     * Removes a PostContent
     *
     * @param \Weisgerber\Forums\Domain\Model\PostContent $postContentToRemove The PostContent to be removed
     * @return void
     */
    public function removePostContent(\Weisgerber\Forums\Domain\Model\PostContent $postContentToRemove)
    {
        $this->postContent->detach($postContentToRemove);
    }

    /**
     * Returns the postContent
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PostContent>
     */
    public function getPostContent()
    {
        return $this->postContent;
    }

    /**
     * Returns the current postContent (the latest version)
     *
     * @return \Weisgerber\Forums\Domain\Model\PostContent
     */
    public function getCurrentPostContent()
    {

        // no check necessary if a postContent > 0 because there MUST be one item
        return $this->postContent[$this->postContent->count() - 1];
    }

    /**
     * Sets the postContent
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PostContent> $postContent
     * @return void
     */
    public function setPostContent(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $postContent)
    {
        $this->postContent = $postContent;
    }

    /**
     * Adds a PostLike
     *
     * @param \Weisgerber\Forums\Domain\Model\PostLike $like
     * @return void
     */
    public function addLike(\Weisgerber\Forums\Domain\Model\PostLike $like)
    {
        $this->likes->attach($like);
    }

    /**
     * Removes a PostLike
     *
     * @param \Weisgerber\Forums\Domain\Model\PostLike $likeToRemove The PostLike to be removed
     * @return void
     */
    public function removeLike(\Weisgerber\Forums\Domain\Model\PostLike $likeToRemove)
    {
        $this->likes->detach($likeToRemove);
    }

    /**
     * Returns the likes
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PostLike>
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Sets the likes
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PostLike> $likes
     * @return void
     */
    public function setLikes(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $likes)
    {
        $this->likes = $likes;
    }

    /**
     * Returns the poll
     *
     * @return \Weisgerber\Forums\Domain\Model\Poll
     */
    public function getPoll()
    {
        return $this->poll;
    }

    /**
     * Sets the poll
     *
     * @param \Weisgerber\Forums\Domain\Model\Poll $poll
     * @return void
     */
    public function setPoll(\Weisgerber\Forums\Domain\Model\Poll $poll)
    {
        $this->poll = $poll;
    }

    /**
     * @param ?FrontendUser $frontenduser
     */
    public function setFrontenduser(?FrontendUser $frontenduser)
    {
        $this->frontenduser = $frontenduser;
    }

    /**
     * Returns the adminComment
     *
     * @return string
     */
    public function getAdminComment()
    {
        return $this->adminComment;
    }

    /**
     * Sets the adminComment
     *
     * @param string $adminComment
     * @return void
     */
    public function setAdminComment(string $adminComment)
    {
        $this->adminComment = $adminComment;
    }

    /**
     * @return \Weisgerber\Forums\Domain\Model\Thread|null
     */
    public function getThread (): ?Thread
    {
        return $this->thread;
    }

    /**
     * @param \Weisgerber\Forums\Domain\Model\Thread|null $thread
     */
    public function setThread (?Thread $thread): void
    {
        $this->thread = $thread;
    }
}
