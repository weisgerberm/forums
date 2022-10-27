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
class PollTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Domain\Model\Poll|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Weisgerber\Forums\Domain\Model\Poll::class,
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
    public function getTitleReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle(): void
    {
        $this->subject->setTitle('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('title'));
    }

    /**
     * @test
     */
    public function getPollVotesReturnsInitialValueForPollVote(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getPollVotes()
        );
    }

    /**
     * @test
     */
    public function setPollVotesForObjectStorageContainingPollVoteSetsPollVotes(): void
    {
        $pollVote = new \Weisgerber\Forums\Domain\Model\PollVote();
        $objectStorageHoldingExactlyOnePollVotes = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOnePollVotes->attach($pollVote);
        $this->subject->setPollVotes($objectStorageHoldingExactlyOnePollVotes);

        self::assertEquals($objectStorageHoldingExactlyOnePollVotes, $this->subject->_get('pollVotes'));
    }

    /**
     * @test
     */
    public function addPollVoteToObjectStorageHoldingPollVotes(): void
    {
        $pollVote = new \Weisgerber\Forums\Domain\Model\PollVote();
        $pollVotesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $pollVotesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($pollVote));
        $this->subject->_set('pollVotes', $pollVotesObjectStorageMock);

        $this->subject->addPollVote($pollVote);
    }

    /**
     * @test
     */
    public function removePollVoteFromObjectStorageHoldingPollVotes(): void
    {
        $pollVote = new \Weisgerber\Forums\Domain\Model\PollVote();
        $pollVotesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $pollVotesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($pollVote));
        $this->subject->_set('pollVotes', $pollVotesObjectStorageMock);

        $this->subject->removePollVote($pollVote);
    }

    /**
     * @test
     */
    public function getPollOptionsReturnsInitialValueForPollOption(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getPollOptions()
        );
    }

    /**
     * @test
     */
    public function setPollOptionsForObjectStorageContainingPollOptionSetsPollOptions(): void
    {
        $pollOption = new \Weisgerber\Forums\Domain\Model\PollOption();
        $objectStorageHoldingExactlyOnePollOptions = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOnePollOptions->attach($pollOption);
        $this->subject->setPollOptions($objectStorageHoldingExactlyOnePollOptions);

        self::assertEquals($objectStorageHoldingExactlyOnePollOptions, $this->subject->_get('pollOptions'));
    }

    /**
     * @test
     */
    public function addPollOptionToObjectStorageHoldingPollOptions(): void
    {
        $pollOption = new \Weisgerber\Forums\Domain\Model\PollOption();
        $pollOptionsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $pollOptionsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($pollOption));
        $this->subject->_set('pollOptions', $pollOptionsObjectStorageMock);

        $this->subject->addPollOption($pollOption);
    }

    /**
     * @test
     */
    public function removePollOptionFromObjectStorageHoldingPollOptions(): void
    {
        $pollOption = new \Weisgerber\Forums\Domain\Model\PollOption();
        $pollOptionsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $pollOptionsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($pollOption));
        $this->subject->_set('pollOptions', $pollOptionsObjectStorageMock);

        $this->subject->removePollOption($pollOption);
    }
}
