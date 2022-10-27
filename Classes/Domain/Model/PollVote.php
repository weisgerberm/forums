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
 * PollVote
 */
class PollVote extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * selectedChoice
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PollOption>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $selectedChoice = null;

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
        $this->selectedChoice = $this->selectedChoice ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a PollOption
     *
     * @param \Weisgerber\Forums\Domain\Model\PollOption $selectedChoice
     * @return void
     */
    public function addSelectedChoice(\Weisgerber\Forums\Domain\Model\PollOption $selectedChoice)
    {
        $this->selectedChoice->attach($selectedChoice);
    }

    /**
     * Removes a PollOption
     *
     * @param \Weisgerber\Forums\Domain\Model\PollOption $selectedChoiceToRemove The PollOption to be removed
     * @return void
     */
    public function removeSelectedChoice(\Weisgerber\Forums\Domain\Model\PollOption $selectedChoiceToRemove)
    {
        $this->selectedChoice->detach($selectedChoiceToRemove);
    }

    /**
     * Returns the selectedChoice
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PollOption>
     */
    public function getSelectedChoice()
    {
        return $this->selectedChoice;
    }

    /**
     * Sets the selectedChoice
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Weisgerber\Forums\Domain\Model\PollOption> $selectedChoice
     * @return void
     */
    public function setSelectedChoice(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $selectedChoice)
    {
        $this->selectedChoice = $selectedChoice;
    }
}
