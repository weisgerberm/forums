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
class PollVoteTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Domain\Model\PollVote|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Weisgerber\Forums\Domain\Model\PollVote::class,
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
    public function getSelectedChoiceReturnsInitialValueForPollOption(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getSelectedChoice()
        );
    }

    /**
     * @test
     */
    public function setSelectedChoiceForObjectStorageContainingPollOptionSetsSelectedChoice(): void
    {
        $selectedChoice = new \Weisgerber\Forums\Domain\Model\PollOption();
        $objectStorageHoldingExactlyOneSelectedChoice = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneSelectedChoice->attach($selectedChoice);
        $this->subject->setSelectedChoice($objectStorageHoldingExactlyOneSelectedChoice);

        self::assertEquals($objectStorageHoldingExactlyOneSelectedChoice, $this->subject->_get('selectedChoice'));
    }

    /**
     * @test
     */
    public function addSelectedChoiceToObjectStorageHoldingSelectedChoice(): void
    {
        $selectedChoice = new \Weisgerber\Forums\Domain\Model\PollOption();
        $selectedChoiceObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $selectedChoiceObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($selectedChoice));
        $this->subject->_set('selectedChoice', $selectedChoiceObjectStorageMock);

        $this->subject->addSelectedChoice($selectedChoice);
    }

    /**
     * @test
     */
    public function removeSelectedChoiceFromObjectStorageHoldingSelectedChoice(): void
    {
        $selectedChoice = new \Weisgerber\Forums\Domain\Model\PollOption();
        $selectedChoiceObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $selectedChoiceObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($selectedChoice));
        $this->subject->_set('selectedChoice', $selectedChoiceObjectStorageMock);

        $this->subject->removeSelectedChoice($selectedChoice);
    }
}
