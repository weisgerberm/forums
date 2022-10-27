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
 * Page
 */
class Page extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    const PAGE_TYPE_SUBFORUM = 95;
    const PAGE_TYPE_SUBFORUM_CATEGORY = 96;

    /**
     * @var string
     */
    protected string $title;

    /**
     * @var string
     */
    protected string $subtitle;

    /**
     * @var int
     */
    protected int $cachedPostCounter;

    /**
     * @var Post|null
     */
    protected ?Post $cachedLatestPost;


    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
     */
    protected $children;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getChildren(): \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
    {
        return $this->children;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $children
     */
    public function setChildren(\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $children): void
    {
        $this->children = $children;
    }

    /**
     * Adds a child
     *
     * @param \Weisgerber\Forums\Domain\Model\Page $page
     * @return void
     */
    public function addChildren(\Weisgerber\Forums\Domain\Model\Page $page)
    {
        $this->children->attach($page);
    }

    /**
     * @return string
     */
    public function getSubtitle (): string
    {
        return $this->subtitle;
    }

    /**
     * @param string $subtitle
     */
    public function setSubtitle (string $subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @return int
     */
    public function getCachedPostCounter (): int
    {
        return $this->cachedPostCounter;
    }

    /**
     * @param int $cachedPostCounter
     */
    public function setCachedPostCounter (int $cachedPostCounter): void
    {
        $this->cachedPostCounter = $cachedPostCounter;
    }

    /**
     * @return \Weisgerber\Forums\Domain\Model\Post|null
     */
    public function getCachedLatestPost (): ?Post
    {
        return $this->cachedLatestPost;
    }

    /**
     * @param \Weisgerber\Forums\Domain\Model\Post|null $cachedLatestPost
     */
    public function setCachedLatestPost (?Post $cachedLatestPost): void
    {
        $this->cachedLatestPost = $cachedLatestPost;
    }
}
