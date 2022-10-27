<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Domain\Repository;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * This file is part of the "forums" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Mark Weisgerber <mark.weisgerber@outlook.de>
 */

/**
 * The repository for Threads
 */
class ThreadRepository extends AbstractRepository
{

    /**
     * @var array
     */
    protected $defaultOrderings = ['sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];

    // Ändern der QuerySettings im Repository eines Models
    public function initializeObject()
    {

        /** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        $contentObj = $this->getConfigurationManager()->getContentObject();
        if (!is_null($contentObj->data)) {

            // when there is a content object, we'll grab the pid from there. Otherwise we try our luck from TSFE
            $querySettings->setStoragePageIds([$contentObj->data['pid']]);
        } else {
            $querySettings->setStoragePageIds([$GLOBALS['TSFE']->id]);
        }
        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * @param $uid
     */
    public function findByUidAssoc($uid)
    {
        $query = $this->createQuery();
        $query->matching($query->equals('uid', $uid));
        return $query->execute(true)[0];
    }
}
