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
class PostReportTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Domain\Model\PostReport|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Weisgerber\Forums\Domain\Model\PostReport::class,
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
    public function getDescriptionReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getDescription()
        );
    }

    /**
     * @test
     */
    public function setDescriptionForStringSetsDescription(): void
    {
        $this->subject->setDescription('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('description'));
    }

    /**
     * @test
     */
    public function getPostReferenceReturnsInitialValueForPost(): void
    {
        self::assertEquals(
            null,
            $this->subject->getPostReference()
        );
    }

    /**
     * @test
     */
    public function setPostReferenceForPostSetsPostReference(): void
    {
        $postReferenceFixture = new \Weisgerber\Forums\Domain\Model\Post();
        $this->subject->setPostReference($postReferenceFixture);

        self::assertEquals($postReferenceFixture, $this->subject->_get('postReference'));
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
}
