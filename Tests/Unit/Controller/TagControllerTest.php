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
class TagControllerTest extends UnitTestCase
{
    /**
     * @var \Weisgerber\Forums\Controller\TagController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Weisgerber\Forums\Controller\TagController::class))
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
    public function createActionAddsTheGivenTagToTagRepository(): void
    {
        $tag = new \Weisgerber\Forums\Domain\Model\Tag();

        $tagRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\TagRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $tagRepository->expects(self::once())->method('add')->with($tag);
        $this->subject->_set('tagRepository', $tagRepository);

        $this->subject->createAction($tag);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenTagFromTagRepository(): void
    {
        $tag = new \Weisgerber\Forums\Domain\Model\Tag();

        $tagRepository = $this->getMockBuilder(\Weisgerber\Forums\Domain\Repository\TagRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $tagRepository->expects(self::once())->method('remove')->with($tag);
        $this->subject->_set('tagRepository', $tagRepository);

        $this->subject->deleteAction($tag);
    }
}
