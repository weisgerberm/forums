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
class PostLikeTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Domain\Model\PostLike|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Weisgerber\Forums\Domain\Model\PostLike::class,
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
