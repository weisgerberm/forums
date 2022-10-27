<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Domain\Repository;


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
 * The repository for Posts
 */
class PostRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = ['sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];

    /**
     * @param int $pageUid
     *
     * @return int
     */
    public function countPosts (int $pageUid = 0):int
    {
        /** @var Typo3QuerySettings $querySettings */
        $query = $this->createQuery();
        if($pageUid>0) {
            $query->getQuerySettings()->setStoragePageIds([$pageUid]);
        }


        return $query->count();
    }

    /**
     * @param int $pageUid
     *
     * @return mixed
     */
    public function findLatest (int $pageUid = 0): mixed
    {
        /** @var Typo3QuerySettings $querySettings */
        $query = $this->createQuery();
        if($pageUid>0) {
            $query->getQuerySettings()->setStoragePageIds([$pageUid]);
        }
        $query->setOrderings(['uid' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING]);
        $query->setLimit(1);


        return $query->execute()->getFirst();
    }
}
