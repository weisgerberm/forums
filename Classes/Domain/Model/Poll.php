<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Domain\Model;


/**
 * This file is part of the "Forums" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Mark Weisgerber <mark.weisgerber@outlook.de>
 */

/**
 * Poll
 */
class Poll extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * pollVotes
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PollVote>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $pollVotes = null;

    /**
     * pollOptions
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PollOption>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $pollOptions = null;

    /**
     * __construct
     */
    public function __construct()
    {

        // Do not remove the next line: It would break the functionality
        $this->initializeObject();
    }

    /**
     * Initializes all ObjectStorage properties when model is reconstructed from DB (where __construct is not called)
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    public function initializeObject()
    {
        $this->pollVotes = $this->pollVotes ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->pollOptions = $this->pollOptions ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a PollVote
     *
     * @param \Weisgerber\Forums\Domain\Model\PollVote $pollVote
     * @return void
     */
    public function addPollVote(\Weisgerber\Forums\Domain\Model\PollVote $pollVote)
    {
        $this->pollVotes->attach($pollVote);
    }

    /**
     * Removes a PollVote
     *
     * @param \Weisgerber\Forums\Domain\Model\PollVote $pollVoteToRemove The PollVote to be removed
     * @return void
     */
    public function removePollVote(\Weisgerber\Forums\Domain\Model\PollVote $pollVoteToRemove)
    {
        $this->pollVotes->detach($pollVoteToRemove);
    }

    /**
     * Returns the pollVotes
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PollVote>
     */
    public function getPollVotes()
    {
        return $this->pollVotes;
    }

    /**
     * Sets the pollVotes
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PollVote> $pollVotes
     * @return void
     */
    public function setPollVotes(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $pollVotes)
    {
        $this->pollVotes = $pollVotes;
    }

    /**
     * Adds a PollOption
     *
     * @param \Weisgerber\Forums\Domain\Model\PollOption $pollOption
     * @return void
     */
    public function addPollOption(\Weisgerber\Forums\Domain\Model\PollOption $pollOption)
    {
        $this->pollOptions->attach($pollOption);
    }

    /**
     * Removes a PollOption
     *
     * @param \Weisgerber\Forums\Domain\Model\PollOption $pollOptionToRemove The PollOption to be removed
     * @return void
     */
    public function removePollOption(\Weisgerber\Forums\Domain\Model\PollOption $pollOptionToRemove)
    {
        $this->pollOptions->detach($pollOptionToRemove);
    }

    /**
     * Returns the pollOptions
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PollOption>
     */
    public function getPollOptions()
    {
        return $this->pollOptions;
    }

    /**
     * Sets the pollOptions
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PollOption> $pollOptions
     * @return void
     */
    public function setPollOptions(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $pollOptions)
    {
        $this->pollOptions = $pollOptions;
    }

    /**
     * Returns the title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}
