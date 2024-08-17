<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Domain\Model;


use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Weisgerber\DarfIchMit\Domain\Model\Traits\{FieldCrDate, FieldPathSegment, FieldTitle, FieldTstamp};

class Thread extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
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
     * files
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $files = null;

    /**
     * posts
     *
     * @var ObjectStorage<Post>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $posts = null;

    /**
     * tags
     *
     * @var ObjectStorage<Tag>
     */
    protected $tags = null;

    /**
     * subscribers
     *
     * @var \Weisgerber\DarfIchMit\Domain\Model\FrontendUser
     */
    protected $subscribers = null;

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
    }

    /**
     * Adds a Post
     *
     * @param Post $post
     * @return void
     */
    public function addPost(Post $post)
    {
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
     * Returns the activeUsers
     *
     * @return \Weisgerber\DarfIchMit\Domain\Model\FrontendUser|null
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }

    /**
     * Sets the activeUsers
     *
     * @param \Weisgerber\DarfIchMit\Domain\Model\FrontendUser $subscribers
     * @return void
     */
    public function setSubscribers(\Weisgerber\DarfIchMit\Domain\Model\FrontendUser $subscribers)
    {
        $this->subscribers = $subscribers;
    }

    /**
     * Returns the files
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Sets the files
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $files
     * @return void
     */
    public function setFiles(\TYPO3\CMS\Extbase\Domain\Model\FileReference $files)
    {
        $this->files = $files;
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
