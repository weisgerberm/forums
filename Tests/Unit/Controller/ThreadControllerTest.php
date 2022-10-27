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
class ThreadControllerTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Controller\ThreadController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Weisgerber\Forums\Controller\ThreadController::class))
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
    public function listActionFetchesAllThreadsFromRepositoryAndAssignsThemToView(): void
    {
        $allThreads = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $threadRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\ThreadRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $threadRepository->expects(self::once())->method('findAll')->will(self::returnValue($allThreads));
        $this->subject->_set('threadRepository', $threadRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('threads', $allThreads);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenThreadToView(): void
    {
        $thread = new \Weisgerber\Forums\Domain\Model\Thread();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('thread', $thread);

        $this->subject->showAction($thread);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenThreadToThreadRepository(): void
    {
        $thread = new \Weisgerber\Forums\Domain\Model\Thread();

        $threadRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\ThreadRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $threadRepository->expects(self::once())->method('add')->with($thread);
        $this->subject->_set('threadRepository', $threadRepository);

        $this->subject->createAction($thread);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenThreadToView(): void
    {
        $thread = new \Weisgerber\Forums\Domain\Model\Thread();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('thread', $thread);

        $this->subject->editAction($thread);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenThreadInThreadRepository(): void
    {
        $thread = new \Weisgerber\Forums\Domain\Model\Thread();

        $threadRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\ThreadRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $threadRepository->expects(self::once())->method('update')->with($thread);
        $this->subject->_set('threadRepository', $threadRepository);

        $this->subject->updateAction($thread);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenThreadFromThreadRepository(): void
    {
        $thread = new \Weisgerber\Forums\Domain\Model\Thread();

        $threadRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\ThreadRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $threadRepository->expects(self::once())->method('remove')->with($thread);
        $this->subject->_set('threadRepository', $threadRepository);

        $this->subject->deleteAction($thread);
    }
}
