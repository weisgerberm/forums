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
class PrivateMessageControllerTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Controller\PrivateMessageController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Weisgerber\Forums\Controller\PrivateMessageController::class))
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
    public function listActionFetchesAllPrivateMessagesFromRepositoryAndAssignsThemToView(): void
    {
        $allPrivateMessages = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $privateMessageRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\PrivateMessageRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $privateMessageRepository->expects(self::once())->method('findAll')->will(self::returnValue($allPrivateMessages));
        $this->subject->_set('privateMessageRepository', $privateMessageRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('privateMessages', $allPrivateMessages);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenPrivateMessageToView(): void
    {
        $privateMessage = new \Weisgerber\Forums\Domain\Model\PrivateMessage();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('privateMessage', $privateMessage);

        $this->subject->showAction($privateMessage);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenPrivateMessageToPrivateMessageRepository(): void
    {
        $privateMessage = new \Weisgerber\Forums\Domain\Model\PrivateMessage();

        $privateMessageRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\PrivateMessageRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $privateMessageRepository->expects(self::once())->method('add')->with($privateMessage);
        $this->subject->_set('privateMessageRepository', $privateMessageRepository);

        $this->subject->createAction($privateMessage);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenPrivateMessageFromPrivateMessageRepository(): void
    {
        $privateMessage = new \Weisgerber\Forums\Domain\Model\PrivateMessage();

        $privateMessageRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\PrivateMessageRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $privateMessageRepository->expects(self::once())->method('remove')->with($privateMessage);
        $this->subject->_set('privateMessageRepository', $privateMessageRepository);

        $this->subject->deleteAction($privateMessage);
    }
}
