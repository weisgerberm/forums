<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Tests\Unit\Domain\Model;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Mark Weisgerber <mark.weisgerber@outlook.de>
 */
class ThreadTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Domain\Model\Thread|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Weisgerber\Forums\Domain\Model\Thread::class,
            ['dummy']
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getHeadlineReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getHeadline()
        );
    }

    /**
     * @test
     */
    public function setHeadlineForStringSetsHeadline(): void
    {
        $this->subject->setHeadline('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('headline'));
    }

    /**
     * @test
     */
    public function getClosedReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getClosed());
    }

    /**
     * @test
     */
    public function setClosedForBoolSetsClosed(): void
    {
        $this->subject->setClosed(true);

        self::assertEquals(true, $this->subject->_get('closed'));
    }

    /**
     * @test
     */
    public function getCachedCounterPostsReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getCachedCounterPosts()
        );
    }

    /**
     * @test
     */
    public function setCachedCounterPostsForIntSetsCachedCounterPosts(): void
    {
        $this->subject->setCachedCounterPosts(12);

        self::assertEquals(12, $this->subject->_get('cachedCounterPosts'));
    }

    /**
     * @test
     */
    public function getCachedCounterViewsReturnsInitialValueForInt(): void
    {
        self::assertSame(
            0,
            $this->subject->getCachedCounterViews()
        );
    }

    /**
     * @test
     */
    public function setCachedCounterViewsForIntSetsCachedCounterViews(): void
    {
        $this->subject->setCachedCounterViews(12);

        self::assertEquals(12, $this->subject->_get('cachedCounterViews'));
    }

    /**
     * @test
     */
    public function getStickyReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getSticky());
    }

    /**
     * @test
     */
    public function setStickyForBoolSetsSticky(): void
    {
        $this->subject->setSticky(true);

        self::assertEquals(true, $this->subject->_get('sticky'));
    }

    /**
     * @test
     */
    public function getSlugReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getSlug()
        );
    }

    /**
     * @test
     */
    public function setSlugForStringSetsSlug(): void
    {
        $this->subject->setSlug('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('slug'));
    }

    /**
     * @test
     */
    public function getFilesReturnsInitialValueForFileReference(): void
    {
        self::assertEquals(
            null,
            $this->subject->getFiles()
        );
    }

    /**
     * @test
     */
    public function setFilesForFileReferenceSetsFiles(): void
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setFiles($fileReferenceFixture);

        self::assertEquals($fileReferenceFixture, $this->subject->_get('files'));
    }

    /**
     * @test
     */
    public function getPostsReturnsInitialValueForPost(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getPosts()
        );
    }

    /**
     * @test
     */
    public function setPostsForObjectStorageContainingPostSetsPosts(): void
    {
        $post = new \Weisgerber\Forums\Domain\Model\Post();
        $objectStorageHoldingExactlyOnePosts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOnePosts->attach($post);
        $this->subject->setPosts($objectStorageHoldingExactlyOnePosts);

        self::assertEquals($objectStorageHoldingExactlyOnePosts, $this->subject->_get('posts'));
    }

    /**
     * @test
     */
    public function addPostToObjectStorageHoldingPosts(): void
    {
        $post = new \Weisgerber\Forums\Domain\Model\Post();
        $postsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $postsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($post));
        $this->subject->_set('posts', $postsObjectStorageMock);

        $this->subject->addPost($post);
    }

    /**
     * @test
     */
    public function removePostFromObjectStorageHoldingPosts(): void
    {
        $post = new \Weisgerber\Forums\Domain\Model\Post();
        $postsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $postsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($post));
        $this->subject->_set('posts', $postsObjectStorageMock);

        $this->subject->removePost($post);
    }

    /**
     * @test
     */
    public function getTagsReturnsInitialValueForTag(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getTags()
        );
    }

    /**
     * @test
     */
    public function setTagsForObjectStorageContainingTagSetsTags(): void
    {
        $tag = new \Weisgerber\Forums\Domain\Model\Tag();
        $objectStorageHoldingExactlyOneTags = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneTags->attach($tag);
        $this->subject->setTags($objectStorageHoldingExactlyOneTags);

        self::assertEquals($objectStorageHoldingExactlyOneTags, $this->subject->_get('tags'));
    }

    /**
     * @test
     */
    public function addTagToObjectStorageHoldingTags(): void
    {
        $tag = new \Weisgerber\Forums\Domain\Model\Tag();
        $tagsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $tagsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($tag));
        $this->subject->_set('tags', $tagsObjectStorageMock);

        $this->subject->addTag($tag);
    }

    /**
     * @test
     */
    public function removeTagFromObjectStorageHoldingTags(): void
    {
        $tag = new \Weisgerber\Forums\Domain\Model\Tag();
        $tagsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $tagsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($tag));
        $this->subject->_set('tags', $tagsObjectStorageMock);

        $this->subject->removeTag($tag);
    }

    /**
     * @test
     */
    public function getActiveUsersReturnsInitialValueForFrontendUser(): void
    {
        self::assertEquals(
            null,
            $this->subject->getActiveUsers()
        );
    }

    /**
     * @test
     */
    public function setActiveUsersForFrontendUserSetsActiveUsers(): void
    {
        $activeUsersFixture = new \Weisgerber\Forums\Domain\Model\FrontendUser();
        $this->subject->setActiveUsers($activeUsersFixture);

        self::assertEquals($activeUsersFixture, $this->subject->_get('activeUsers'));
    }
}
