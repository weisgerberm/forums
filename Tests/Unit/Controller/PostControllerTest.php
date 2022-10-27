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
class PostControllerTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Controller\PostController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Weisgerber\Forums\Controller\PostController::class))
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
    public function createActionAddsTheGivenPostToPostRepository(): void
    {
        $post = new \Weisgerber\Forums\Domain\Model\Post();

        $postRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\PostRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $postRepository->expects(self::once())->method('add')->with($post);
        $this->subject->_set('postRepository', $postRepository);

        $this->subject->createAction($post);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenPostToView(): void
    {
        $post = new \Weisgerber\Forums\Domain\Model\Post();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('post', $post);

        $this->subject->editAction($post);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenPostInPostRepository(): void
    {
        $post = new \Weisgerber\Forums\Domain\Model\Post();

        $postRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\PostRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $postRepository->expects(self::once())->method('update')->with($post);
        $this->subject->_set('postRepository', $postRepository);

        $this->subject->updateAction($post);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenPostFromPostRepository(): void
    {
        $post = new \Weisgerber\Forums\Domain\Model\Post();

        $postRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\PostRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $postRepository->expects(self::once())->method('remove')->with($post);
        $this->subject->_set('postRepository', $postRepository);

        $this->subject->deleteAction($post);
    }
}
