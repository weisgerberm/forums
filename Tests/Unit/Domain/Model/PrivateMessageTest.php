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
class PrivateMessageTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Domain\Model\PrivateMessage|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Weisgerber\Forums\Domain\Model\PrivateMessage::class,
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
    public function getSubjectReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getSubject()
        );
    }

    /**
     * @test
     */
    public function setSubjectForStringSetsSubject(): void
    {
        $this->subject->setSubject('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('subject'));
    }

    /**
     * @test
     */
    public function getContentReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getContent()
        );
    }

    /**
     * @test
     */
    public function setContentForStringSetsContent(): void
    {
        $this->subject->setContent('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('content'));
    }

    /**
     * @test
     */
    public function getSenderReturnsInitialValueForFrontendUser(): void
    {
        self::assertEquals(
            null,
            $this->subject->getSender()
        );
    }

    /**
     * @test
     */
    public function setSenderForFrontendUserSetsSender(): void
    {
        $senderFixture = new \Weisgerber\Forums\Domain\Model\FrontendUser();
        $this->subject->setSender($senderFixture);

        self::assertEquals($senderFixture, $this->subject->_get('sender'));
    }

    /**
     * @test
     */
    public function getReceiverReturnsInitialValueForFrontendUser(): void
    {
        self::assertEquals(
            null,
            $this->subject->getReceiver()
        );
    }

    /**
     * @test
     */
    public function setReceiverForFrontendUserSetsReceiver(): void
    {
        $receiverFixture = new \Weisgerber\Forums\Domain\Model\FrontendUser();
        $this->subject->setReceiver($receiverFixture);

        self::assertEquals($receiverFixture, $this->subject->_get('receiver'));
    }
}
