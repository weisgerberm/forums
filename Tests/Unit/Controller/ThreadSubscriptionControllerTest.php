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
class ThreadSubscriptionControllerTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Controller\ThreadSubscriptionController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Weisgerber\Forums\Controller\ThreadSubscriptionController::class))
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
    public function createActionAddsTheGivenThreadSubscriptionToThreadSubscriptionRepository(): void
    {
        $threadSubscription = new \Weisgerber\Forums\Domain\Model\ThreadSubscription();

        $threadSubscriptionRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\ThreadSubscriptionRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $threadSubscriptionRepository->expects(self::once())->method('add')->with($threadSubscription);
        $this->subject->_set('threadSubscriptionRepository', $threadSubscriptionRepository);

        $this->subject->createAction($threadSubscription);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenThreadSubscriptionFromThreadSubscriptionRepository(): void
    {
        $threadSubscription = new \Weisgerber\Forums\Domain\Model\ThreadSubscription();

        $threadSubscriptionRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\ThreadSubscriptionRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $threadSubscriptionRepository->expects(self::once())->method('remove')->with($threadSubscription);
        $this->subject->_set('threadSubscriptionRepository', $threadSubscriptionRepository);

        $this->subject->deleteAction($threadSubscription);
    }
}
