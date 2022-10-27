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
class FrontendUserControllerTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Controller\FrontendUserController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Weisgerber\Forums\Controller\FrontendUserController::class))
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
    public function listActionFetchesAllFrontendUsersFromRepositoryAndAssignsThemToView(): void
    {
        $allFrontendUsers = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $frontendUserRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\FrontendUserRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $frontendUserRepository->expects(self::once())->method('findAll')->will(self::returnValue($allFrontendUsers));
        $this->subject->_set('frontendUserRepository', $frontendUserRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('frontendUsers', $allFrontendUsers);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenFrontendUserToView(): void
    {
        $frontendUser = new \Weisgerber\Forums\Domain\Model\FrontendUser();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('frontendUser', $frontendUser);

        $this->subject->showAction($frontendUser);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenFrontendUserToView(): void
    {
        $frontendUser = new \Weisgerber\Forums\Domain\Model\FrontendUser();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('frontendUser', $frontendUser);

        $this->subject->editAction($frontendUser);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenFrontendUserInFrontendUserRepository(): void
    {
        $frontendUser = new \Weisgerber\Forums\Domain\Model\FrontendUser();

        $frontendUserRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\FrontendUserRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $frontendUserRepository->expects(self::once())->method('update')->with($frontendUser);
        $this->subject->_set('frontendUserRepository', $frontendUserRepository);

        $this->subject->updateAction($frontendUser);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenFrontendUserFromFrontendUserRepository(): void
    {
        $frontendUser = new \Weisgerber\Forums\Domain\Model\FrontendUser();

        $frontendUserRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\FrontendUserRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $frontendUserRepository->expects(self::once())->method('remove')->with($frontendUser);
        $this->subject->_set('frontendUserRepository', $frontendUserRepository);

        $this->subject->deleteAction($frontendUser);
    }
}
