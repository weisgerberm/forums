<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Domain\Model;


/**
 * This file is part of the "forums" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Mark Weisgerber <mark.weisgerber@outlook.de>
 */

/**
 * ThreadSubscription
 */
class ThreadSubscription extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    public const string TABLE_NAME = 'tx_forums_domain_model_threadsubscription';
    /**
     * threadReference
     *
     * @var \Weisgerber\Forums\Domain\Model\Thread
     */
    protected $threadReference = null;

    /**
     * Returns the threadReference
     *
     * @return \Weisgerber\Forums\Domain\Model\Thread
     */
    public function getThreadReference()
    {
        return $this->threadReference;
    }

    /**
     * Sets the threadReference
     *
     * @param \Weisgerber\Forums\Domain\Model\Thread $threadReference
     * @return void
     */
    public function setThreadReference(\Weisgerber\Forums\Domain\Model\Thread $threadReference)
    {
        $this->threadReference = $threadReference;
    }
}
