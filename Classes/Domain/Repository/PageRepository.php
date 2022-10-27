<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Domain\Repository;


use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;

/**
 * This file is part of the "forums" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Mark Weisgerber <mark.weisgerber@outlook.de>
 */

/**
 * The repository for Pages
 */
class PageRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * searches for pages by pid uid, but respects the given storage pid
     * @param int|null $uid
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function findByPid(?int $uid)
    {
        /** @var Typo3QuerySettings $querySettings */
        $query = $this->createQuery();
        $query->getQuerySettings()->setStoragePageIds([$uid]);
        $query->matching(
            $query->equals('pid', $uid)
        );


        return $query->execute();
    }
}
