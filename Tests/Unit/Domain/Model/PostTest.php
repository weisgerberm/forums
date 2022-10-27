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
class PostTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Domain\Model\Post|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Weisgerber\Forums\Domain\Model\Post::class,
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
    public function getSpamReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getSpam());
    }

    /**
     * @test
     */
    public function setSpamForBoolSetsSpam(): void
    {
        $this->subject->setSpam(true);

        self::assertEquals(true, $this->subject->_get('spam'));
    }

    /**
     * @test
     */
    public function getAwaitingAdminApprovalReturnsInitialValueForBool(): void
    {
        self::assertFalse($this->subject->getAwaitingAdminApproval());
    }

    /**
     * @test
     */
    public function setAwaitingAdminApprovalForBoolSetsAwaitingAdminApproval(): void
    {
        $this->subject->setAwaitingAdminApproval(true);

        self::assertEquals(true, $this->subject->_get('awaitingAdminApproval'));
    }

    /**
     * @test
     */
    public function getPostContentReturnsInitialValueForPostContent(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getPostContent()
        );
    }

    /**
     * @test
     */
    public function setPostContentForObjectStorageContainingPostContentSetsPostContent(): void
    {
        $postContent = new \Weisgerber\Forums\Domain\Model\PostContent();
        $objectStorageHoldingExactlyOnePostContent = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOnePostContent->attach($postContent);
        $this->subject->setPostContent($objectStorageHoldingExactlyOnePostContent);

        self::assertEquals($objectStorageHoldingExactlyOnePostContent, $this->subject->_get('postContent'));
    }

    /**
     * @test
     */
    public function addPostContentToObjectStorageHoldingPostContent(): void
    {
        $postContent = new \Weisgerber\Forums\Domain\Model\PostContent();
        $postContentObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $postContentObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($postContent));
        $this->subject->_set('postContent', $postContentObjectStorageMock);

        $this->subject->addPostContent($postContent);
    }

    /**
     * @test
     */
    public function removePostContentFromObjectStorageHoldingPostContent(): void
    {
        $postContent = new \Weisgerber\Forums\Domain\Model\PostContent();
        $postContentObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $postContentObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($postContent));
        $this->subject->_set('postContent', $postContentObjectStorageMock);

        $this->subject->removePostContent($postContent);
    }

    /**
     * @test
     */
    public function getLikesReturnsInitialValueForPostLike(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getLikes()
        );
    }

    /**
     * @test
     */
    public function setLikesForObjectStorageContainingPostLikeSetsLikes(): void
    {
        $like = new \Weisgerber\Forums\Domain\Model\PostLike();
        $objectStorageHoldingExactlyOneLikes = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneLikes->attach($like);
        $this->subject->setLikes($objectStorageHoldingExactlyOneLikes);

        self::assertEquals($objectStorageHoldingExactlyOneLikes, $this->subject->_get('likes'));
    }

    /**
     * @test
     */
    public function addLikeToObjectStorageHoldingLikes(): void
    {
        $like = new \Weisgerber\Forums\Domain\Model\PostLike();
        $likesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $likesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($like));
        $this->subject->_set('likes', $likesObjectStorageMock);

        $this->subject->addLike($like);
    }

    /**
     * @test
     */
    public function removeLikeFromObjectStorageHoldingLikes(): void
    {
        $like = new \Weisgerber\Forums\Domain\Model\PostLike();
        $likesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $likesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($like));
        $this->subject->_set('likes', $likesObjectStorageMock);

        $this->subject->removeLike($like);
    }

    /**
     * @test
     */
    public function getPollReturnsInitialValueForPoll(): void
    {
        self::assertEquals(
            null,
            $this->subject->getPoll()
        );
    }

    /**
     * @test
     */
    public function setPollForPollSetsPoll(): void
    {
        $pollFixture = new \Weisgerber\Forums\Domain\Model\Poll();
        $this->subject->setPoll($pollFixture);

        self::assertEquals($pollFixture, $this->subject->_get('poll'));
    }
}
