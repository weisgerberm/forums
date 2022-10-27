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
class ThreadSubscriptionTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Domain\Model\ThreadSubscription|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Weisgerber\Forums\Domain\Model\ThreadSubscription::class,
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
    public function getThreadReferenceReturnsInitialValueForThread(): void
    {
        self::assertEquals(
            null,
            $this->subject->getThreadReference()
        );
    }

    /**
     * @test
     */
    public function setThreadReferenceForThreadSetsThreadReference(): void
    {
        $threadReferenceFixture = new \Weisgerber\Forums\Domain\Model\Thread();
        $this->subject->setThreadReference($threadReferenceFixture);

        self::assertEquals($threadReferenceFixture, $this->subject->_get('threadReference'));
    }
}
