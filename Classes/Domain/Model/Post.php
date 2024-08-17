<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Weisgerber\DarfIchMit\Domain\Model\Traits\FieldFrontenduser;
use Weisgerber\DarfIchMit\Domain\Model\Traits\FieldSoftDeleted;

class Post extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    use FieldFrontenduser;
    use FieldSoftDeleted;

    public const string TABLE_NAME = 'tx_forums_domain_model_post';

    /**
     * related thread
     *
     * @var \Weisgerber\Forums\Domain\Model\Thread
     */
    #[Lazy()]
    protected $thread = null;

    /**
     * quote
     *
     * @var \Weisgerber\Forums\Domain\Model\PostContent
     */
    #[Lazy()]
    protected $quote = null;

    /**
     * spam
     *
     * @var bool
     */
    protected bool $spam = false;

    /**
     * awaitingAdminApproval
     *
     * @var bool
     */
    protected bool $awaitingAdminApproval = false;

    /**
     * adminComment
     *
     * @var string
     */
    protected string $adminComment = '';

    /**
     * multiple PostContent Objects for history and edit mode
     *
     * Muss nicht lazy sein und könnte ggf. eher negativ sein, weil wir bei einem post eigentlich IMMER den postcontent benötigen
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PostContent>
     */
    #[Cascade(['value' => 'remove'])]
    protected ObjectStorage|null $postContent = null;

    /**
     * likes
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PostLike>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    #[Lazy()]
    protected $likes = null;

    /**
     * poll
     *
     * @var \Weisgerber\Forums\Domain\Model\Poll
     */
    #[Lazy()]
    protected $poll = null;

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
    public function getPostContent():ObjectStorage
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
        return $this->getPostContent()[$this->postContent->count() - 1];
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
        if ($this->likes instanceof LazyLoadingProxy) {
            $this->likes->_loadRealInstance();
        }
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
        if ($this->poll instanceof LazyLoadingProxy) {
            $this->poll->_loadRealInstance();
        }
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
    public function getThread()
    {
        if ($this->thread instanceof LazyLoadingProxy) {
            $this->thread->_loadRealInstance();
        }
        return $this->thread;
    }

    /**
     * @param ?Thread $thread
     */
    public function setThread(?Thread $thread)
    {
        $this->thread = $thread;
    }

    public function isEdited(): bool
    {
        return (count($this->getPostContent()) > 1);
    }

    public function getQuote(): ?PostContent
    {
        if ($this->quote instanceof LazyLoadingProxy) {
            $this->quote->_loadRealInstance();
        }
        return $this->quote;
    }

    public function setQuote(?PostContent $quote): void
    {
        $this->quote = $quote;
    }
}
