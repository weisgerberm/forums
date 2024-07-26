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
 * Thread
 */
class Thread extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    public const string TABLE_NAME = 'tx_forums_domain_model_thread';
    /**
     * threads headline / subject
     *
     * @var string
     */
    protected string $headline = '';

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
    protected $cachedCounterPosts = 0;

    /**
     * cached value for better performance
     *
     * @var int
     */
    protected $cachedCounterViews = 0;

    /**
     * sticky on top of the subforum
     *
     * @var bool
     */
    protected $sticky = false;

    /**
     * url slug
     *
     * @var string
     */
    protected $slug = '';

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
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\Post>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $posts = null;

    /**
     * tags
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\Tag>
     */
    protected $tags = null;

    /**
     * activeUsers
     *
     * @var \Weisgerber\DarfIchMit\Domain\Model\FrontendUser
     */
    protected $activeUsers = null;

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
        $this->posts = $this->posts ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->tags = $this->tags ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a Post
     *
     * @param \Weisgerber\Forums\Domain\Model\Post $post
     * @return void
     */
    public function addPost(\Weisgerber\Forums\Domain\Model\Post $post)
    {
        $this->posts->attach($post);
    }

    /**
     * Removes a Post
     *
     * @param \Weisgerber\Forums\Domain\Model\Post $postToRemove The Post to be removed
     * @return void
     */
    public function removePost(\Weisgerber\Forums\Domain\Model\Post $postToRemove)
    {
        $this->posts->detach($postToRemove);
    }

    /**
     * Returns the posts
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\Post>
     */
    public function getPosts(): \TYPO3\CMS\Extbase\Persistence\ObjectStorage
    {
        return $this->posts;
    }

    /**
     * Sets the posts
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\Post> $posts
     * @return void
     */
    public function setPosts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $posts)
    {
        $this->posts = $posts;
    }

    /**
     * @return \Weisgerber\Forums\Domain\Model\Post
     */
    public function getFirstPost()
    {
        return $this->getPosts()->offsetGet(0);
    }

    /**
     * @return \Weisgerber\Forums\Domain\Model\Post
     */
    public function getLastPost()
    {
        return $this->getPosts()->offsetGet($this->getPosts()->count() - 1);
    }

    /**
     * Returns the headline
     *
     * @return string
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Sets the headline
     *
     * @param string $headline
     * @return void
     */
    public function setHeadline(string $headline)
    {
        $this->headline = $headline;
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
     * @param \Weisgerber\Forums\Domain\Model\Tag $tag
     * @return void
     */
    public function addTag(\Weisgerber\Forums\Domain\Model\Tag $tag)
    {
        $this->tags->attach($tag);
    }

    /**
     * Removes a Tag
     *
     * @param \Weisgerber\Forums\Domain\Model\Tag $tagToRemove The Tag to be removed
     * @return void
     */
    public function removeTag(\Weisgerber\Forums\Domain\Model\Tag $tagToRemove)
    {
        $this->tags->detach($tagToRemove);
    }

    /**
     * Returns the tags
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\Tag>
     */
    public function getTags(): \TYPO3\CMS\Extbase\Persistence\ObjectStorage
    {
        return $this->tags;
    }

    /**
     * Sets the tags
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\Tag> $tags
     * @return void
     */
    public function setTags(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $tags)
    {
        $this->tags = $tags;
    }

    /**
     * Returns the activeUsers
     *
     * @return \Weisgerber\DarfIchMit\Domain\Model\FrontendUser|null
     */
    public function getActiveUsers()
    {
        return $this->activeUsers;
    }

    /**
     * Sets the activeUsers
     *
     * @param \Weisgerber\DarfIchMit\Domain\Model\FrontendUser $activeUsers
     * @return void
     */
    public function setActiveUsers(\Weisgerber\DarfIchMit\Domain\Model\FrontendUser $activeUsers)
    {
        $this->activeUsers = $activeUsers;
    }

    /**
     * Returns the slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Sets the slug
     *
     * @param string $slug
     * @return void
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;
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
}
