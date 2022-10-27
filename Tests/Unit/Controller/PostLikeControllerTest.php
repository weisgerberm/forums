<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Tests\Unit\Controller;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use TYPO3Fluid\Fluid\View\ViewInterface;

/**
 * Test case
 *
 * @author Mark Weisgerber <mark.weisgerber@outlook.de>
 */
class PostLikeControllerTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Controller\PostLikeController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Weisgerber\Forums\Controller\PostLikeController::class))
            ->onlyMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenPostLikeToPostLikeRepository(): void
    {
        $postLike = new \Weisgerber\Forums\Domain\Model\PostLike();

        $postLikeRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\PostLikeRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $postLikeRepository->expects(self::once())->method('add')->with($postLike);
        $this->subject->_set('postLikeRepository', $postLikeRepository);

        $this->subject->createAction($postLike);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenPostLikeFromPostLikeRepository(): void
    {
        $postLike = new \Weisgerber\Forums\Domain\Model\PostLike();

        $postLikeRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\PostLikeRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $postLikeRepository->expects(self::once())->method('remove')->with($postLike);
        $this->subject->_set('postLikeRepository', $postLikeRepository);

        $this->subject->deleteAction($postLike);
    }
}
