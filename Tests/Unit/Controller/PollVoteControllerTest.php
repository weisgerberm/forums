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
class PollVoteControllerTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Controller\PollVoteController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Weisgerber\Forums\Controller\PollVoteController::class))
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
    public function createActionAddsTheGivenPollVoteToPollVoteRepository(): void
    {
        $pollVote = new \Weisgerber\Forums\Domain\Model\PollVote();

        $pollVoteRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\PollVoteRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $pollVoteRepository->expects(self::once())->method('add')->with($pollVote);
        $this->subject->_set('pollVoteRepository', $pollVoteRepository);

        $this->subject->createAction($pollVote);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenPollVoteFromPollVoteRepository(): void
    {
        $pollVote = new \Weisgerber\Forums\Domain\Model\PollVote();

        $pollVoteRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\PollVoteRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $pollVoteRepository->expects(self::once())->method('remove')->with($pollVote);
        $this->subject->_set('pollVoteRepository', $pollVoteRepository);

        $this->subject->deleteAction($pollVote);
    }
}
