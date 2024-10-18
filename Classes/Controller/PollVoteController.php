<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Controller;


use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;/**
 * This file is part of the "Forums" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2022 Mark Weisgerber <mark.weisgerber@outlook.de>
 */

/**
 * PollVoteController
 */
class PollVoteController extends AbstractController
{

    /**
     * pollVoteRepository
     *
     * @var \Weisgerber\Forums\Domain\Repository\PollVoteRepository
     */
    protected $pollVoteRepository = null;

    /**
     * @param \Weisgerber\Forums\Domain\Repository\PollVoteRepository $pollVoteRepository
     */
    public function injectPollVoteRepository(\Weisgerber\Forums\Domain\Repository\PollVoteRepository $pollVoteRepository)
    {
        $this->pollVoteRepository = $pollVoteRepository;
    }

    /**
     * action new
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function newAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action create
     *
     * @param \Weisgerber\Forums\Domain\Model\PollVote $newPollVote
     */
    public function createAction(\Weisgerber\Forums\Domain\Model\PollVote $newPollVote)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', ContextualFeedbackSeverity::WARNING);
        $this->pollVoteRepository->add($newPollVote);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Weisgerber\Forums\Domain\Model\PollVote $pollVote
     */
    public function deleteAction(\Weisgerber\Forums\Domain\Model\PollVote $pollVote)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', ContextualFeedbackSeverity::WARNING);
        $this->pollVoteRepository->remove($pollVote);
        $this->redirect('list');
    }
}
