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
 * ThreadState
 */
class ThreadState extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject
{
    public const string TABLE_NAME = 'tx_forums_domain_model_threadstate';
    /**
     * the last time, the frontenduser visited this thread. Important to display,
     * whether there are now posts or not
     *
     * @var \DateTime
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $lastVisit = null;

    /**
     * frontendUser
     *
     * @var \Weisgerber\DarfIchMit\Domain\Model\FrontendUser
     */
    protected $frontendUser = null;

    /**
     * thread
     *
     * @var \Weisgerber\Forums\Domain\Model\Thread
     */
    protected $thread = null;

    /**
     * Returns the lastVisit
     *
     * @return \DateTime
     */
    public function getLastVisit()
    {
        return $this->lastVisit;
    }

    /**
     * Sets the lastVisit
     *
     * @param \DateTime $lastVisit
     * @return void
     */
    public function setLastVisit(\DateTime $lastVisit)
    {
        $this->lastVisit = $lastVisit;
    }

    /**
     * Returns the frontendUser
     *
     * @return \Weisgerber\DarfIchMit\Domain\Model\FrontendUser
     */
    public function getFrontendUser()
    {
        return $this->frontendUser;
    }

    /**
     * Sets the frontendUser
     *
     * @param \Weisgerber\DarfIchMit\Domain\Model\FrontendUser $frontendUser
     * @return void
     */
    public function setFrontendUser(\Weisgerber\DarfIchMit\Domain\Model\FrontendUser $frontendUser)
    {
        $this->frontendUser = $frontendUser;
    }

    /**
     * Returns the thread
     *
     * @return \Weisgerber\Forums\Domain\Model\Thread
     */
    public function getThread()
    {
        return $this->thread;
    }

    /**
     * Sets the thread
     *
     * @param \Weisgerber\Forums\Domain\Model\Thread $thread
     * @return void
     */
    public function setThread(\Weisgerber\Forums\Domain\Model\Thread $thread)
    {
        $this->thread = $thread;
    }
}
