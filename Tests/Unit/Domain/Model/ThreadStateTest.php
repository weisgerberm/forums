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
class ThreadStateTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Domain\Model\ThreadState|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Weisgerber\Forums\Domain\Model\ThreadState::class,
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
    public function getLastVisitReturnsInitialValueForDateTime(): void
    {
        self::assertEquals(
            null,
            $this->subject->getLastVisit()
        );
    }

    /**
     * @test
     */
    public function setLastVisitForDateTimeSetsLastVisit(): void
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setLastVisit($dateTimeFixture);

        self::assertEquals($dateTimeFixture, $this->subject->_get('lastVisit'));
    }

    /**
     * @test
     */
    public function getFrontendUserReturnsInitialValueForFrontendUser(): void
    {
        self::assertEquals(
            null,
            $this->subject->getFrontendUser()
        );
    }

    /**
     * @test
     */
    public function setFrontendUserForFrontendUserSetsFrontendUser(): void
    {
        $frontendUserFixture = new \Weisgerber\Forums\Domain\Model\FrontendUser();
        $this->subject->setFrontendUser($frontendUserFixture);

        self::assertEquals($frontendUserFixture, $this->subject->_get('frontendUser'));
    }

    /**
     * @test
     */
    public function getThreadReturnsInitialValueForThread(): void
    {
        self::assertEquals(
            null,
            $this->subject->getThread()
        );
    }

    /**
     * @test
     */
    public function setThreadForThreadSetsThread(): void
    {
        $threadFixture = new \Weisgerber\Forums\Domain\Model\Thread();
        $this->subject->setThread($threadFixture);

        self::assertEquals($threadFixture, $this->subject->_get('thread'));
    }
}
