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
class PollOptionControllerTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Controller\PollOptionController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Weisgerber\Forums\Controller\PollOptionController::class))
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
    public function createActionAddsTheGivenPollOptionToPollOptionRepository(): void
    {
        $pollOption = new \Weisgerber\Forums\Domain\Model\PollOption();

        $pollOptionRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\PollOptionRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $pollOptionRepository->expects(self::once())->method('add')->with($pollOption);
        $this->subject->_set('pollOptionRepository', $pollOptionRepository);

        $this->subject->createAction($pollOption);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenPollOptionFromPollOptionRepository(): void
    {
        $pollOption = new \Weisgerber\Forums\Domain\Model\PollOption();

        $pollOptionRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\PollOptionRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $pollOptionRepository->expects(self::once())->method('remove')->with($pollOption);
        $this->subject->_set('pollOptionRepository', $pollOptionRepository);

        $this->subject->deleteAction($pollOption);
    }
}
