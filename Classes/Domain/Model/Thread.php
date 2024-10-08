<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Domain\Model;


use DateTime;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Weisgerber\DarfIchMit\Domain\Model\Traits\{FieldCrDate, FieldPathSegment, FieldTitle, FieldTstamp};
use Weisgerber\DarfIchMit\Domain\Model\Abstract\AbstractModel;
use Weisgerber\DarfIchMit\Domain\Model\FrontendUser;

class Thread extends AbstractModel
{
    use FieldPathSegment;
    use FieldTitle;
    use FieldCrDate;
    use FieldTstamp;

    public const string TABLE_NAME = 'tx_forums_domain_model_thread';

    /**
     * flag whether the thread is closed for further posts
     *
     * @var bool
     */
    protected bool $closed = false;

    /**
     * cached value for better performance
     *
     * @var int
     */
    protected int $cachedCounterPosts = 0;

    /**
     * cached value for better performance
     *
     * @var int
     */
    protected int $cachedCounterViews = 0;

    /**
     * sticky on top of the subforum
     *
     * @var bool
     */
    protected bool $sticky = false;

    /**
     * All posts related to this thread
     *
     * @var ObjectStorage<Post>
     */
    #[Cascade(['value' => 'remove'])]
    #[Lazy()]
    protected $posts = null;

    /**
     * tags
     *
     * @var ObjectStorage<Tag>
     */
    #[Lazy()]
    protected $tags = null;

    /**
     * List of subscribers to this thread
     *
     * @var ObjectStorage<\Weisgerber\DarfIchMit\Domain\Model\FrontendUser>
     */
    #[Lazy()]
    protected $subscribers = null;

    protected ?DateTime $lastPostedOn;

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
        $this->posts = $this->posts ?: new ObjectStorage();
        $this->tags = $this->tags ?: new ObjectStorage();
        $this->subscribers = $this->subscribers ?: new ObjectStorage();
    }

    /**
     * Adds a Post
     *
     * @param Post $post
     * @return void
     */
    public function addPost(Post $post)
    {
        $this->setLastPostedOn(new DateTime());
        $this->setCachedCounterPosts(count($this->posts));
        $this->posts->attach($post);
    }

    /**
     * Removes a Post
     *
     * @param Post $postToRemove The Post to be removed
     * @return void
     */
    public function removePost(Post $postToRemove)
    {
        $this->posts->detach($postToRemove);
    }

    /**
     * Returns the posts
     *
     * @return ObjectStorage<Post>
     */
    public function getPosts(): ObjectStorage
    {
        if ($this->posts instanceof LazyLoadingProxy) {
            $this->posts->_loadRealInstance();
        }
        return $this->posts;
    }

    /**
     * Sets the posts
     *
     * @param ObjectStorage<Post> $posts
     * @return void
     */
    public function setPosts(ObjectStorage $posts)
    {
        $this->posts = $posts;
    }

    /**
     * @return Post
     */
    public function getFirstPost()
    {
        return $this->getPosts()->offsetGet(0);
    }

    /**
     * @return Post
     */
    public function getLastPost()
    {
        return $this->getPosts()->offsetGet($this->getPosts()->count() - 1);
    }

    public function getLastPostedOn(): ?DateTime
    {
        return $this->lastPostedOn;
    }

    public function setLastPostedOn(?DateTime $lastPostedOn): void
    {
        $this->lastPostedOn = $lastPostedOn;
    }

    /**
     * Returns the closed
     *
     * @return bool
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * Sets the closed
     *
     * @param bool $closed
     * @return void
     */
    public function setClosed(bool $closed)
    {
        $this->closed = $closed;
    }

    /**
     * Returns the boolean state of closed
     *
     * @return bool
     */
    public function isClosed()
    {
        return $this->closed;
    }

    /**
     * Returns the cachedCounterPosts
     *
     * @return int
     */
    public function getCachedCounterPosts()
    {
        return $this->cachedCounterPosts;
    }

    /**
     * Sets the cachedCounterPosts
     *
     * @param int $cachedCounterPosts
     * @return void
     */
    public function setCachedCounterPosts(int $cachedCounterPosts)
    {
        $this->cachedCounterPosts = $cachedCounterPosts;
    }

    /**
     * Returns the cachedCounterViews
     *
     * @return int
     */
    public function getCachedCounterViews()
    {
        return $this->cachedCounterViews;
    }

    /**
     * Sets the cachedCounterViews
     *
     * @param int $cachedCounterViews
     * @return void
     */
    public function setCachedCounterViews(int $cachedCounterViews)
    {
        $this->cachedCounterViews = $cachedCounterViews;
    }

    /**
     * Returns the sticky
     *
     * @return bool
     */
    public function getSticky()
    {
        return $this->sticky;
    }

    /**
     * Sets the sticky
     *
     * @param bool $sticky
     * @return void
     */
    public function setSticky(bool $sticky)
    {
        $this->sticky = $sticky;
    }

    /**
     * Returns the boolean state of sticky
     *
     * @return bool
     */
    public function isSticky()
    {
        return $this->sticky;
    }

    /**
     * Adds a Tag
     *
     * @param Tag $tag
     * @return void
     */
    public function addTag(Tag $tag)
    {
        $this->tags->attach($tag);
    }

    /**
     * Removes a Tag
     *
     * @param Tag $tagToRemove The Tag to be removed
     * @return void
     */
    public function removeTag(Tag $tagToRemove)
    {
        $this->tags->detach($tagToRemove);
    }

    /**
     * Returns the tags
     *
     * @return ObjectStorage<Tag>
     */
    public function getTags(): ObjectStorage
    {
        if ($this->tags instanceof LazyLoadingProxy) {
            $this->tags->_loadRealInstance();
        }
        return $this->tags;
    }

    /**
     * Sets the tags
     *
     * @param ObjectStorage<Tag> $tags
     * @return void
     */
    public function setTags(ObjectStorage $tags)
    {
        $this->tags = $tags;
    }

    /**
     * Returns all subscribers of this thread
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage|null
     */
    public function getSubscribers()
    {
        if ($this->subscribers instanceof LazyLoadingProxy) {
            $this->subscribers->_loadRealInstance();
        }
        return $this->subscribers;
    }

    /**
     * Adds a subscriber to the thread
     *
     * @param FrontendUser $frontendUser
     * @return void
     */
    public function addSubscriber(FrontendUser $frontendUser): void
    {
        $this->subscribers->attach($frontendUser);
    }

    /**
     * Checks if the given user is already a subscriber
     *
     * @param \Weisgerber\DarfIchMit\Domain\Model\FrontendUser $frontendUser
     * @return bool
     */
    public function hasSubscriber(FrontendUser $frontendUser): bool
    {
        return $this->subscribers->contains($frontendUser);
    }

    /**
     * Sets the activeUsers
     *
     * @param \Weisgerber\DarfIchMit\Domain\Model\FrontendUser $subscribers
     * @return void
     */
    public function setSubscribers(\Weisgerber\DarfIchMit\Domain\Model\FrontendUser $subscribers): void
    {
        $this->subscribers = $subscribers;
    }

    public function jsonSerialize(): array
    {
        return [
            'uid' => $this->getUid(),
            'pid' => $this->getPid(),
            'title' => $this->getTitle(),
        ];
    }
}
