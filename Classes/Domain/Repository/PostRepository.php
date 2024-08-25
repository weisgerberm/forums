<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use Weisgerber\DarfIchMit\Domain\Model\FrontendUser;

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
    protected $defaultOrderings = ['crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING];

    /**
     * @param int $pageUid
     * @return int
     */
    public function countPosts(int $pageUid = 0)
    {

        /** @var Typo3QuerySettings $querySettings */
        $query = $this->createQuery();
        if ($pageUid > 0) {
            $query->getQuerySettings()->setStoragePageIds([$pageUid]);
        }
        return $query->count();
    }

    /**
     * @param int $pageUid restrict to a page; 0 for no restriction
     * @return mixed
     */
    public function findLatest(int $pageUid = 0)
    {

        /** @var Typo3QuerySettings $querySettings */
        $query = $this->createQuery();
        if ($pageUid > 0) {
            $query->getQuerySettings()->setStoragePageIds([$pageUid]);
        }else{
            $query->getQuerySettings()->setRespectStoragePage(false);
        }
        $query->setOrderings(['uid' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING]);
        $query->setLimit(1);
        return $query->execute()->getFirst();
    }

    /**
     * @param int $pageUid restrict to a page; 0 for no restriction
     * @param int $limit
     * @return mixed
     */
    public function findLatestAmount(int $pageUid = 0, int $limit = 15)
    {

        /** @var Typo3QuerySettings $querySettings */
        $query = $this->createQuery();
        if ($pageUid > 0) {
            $query->getQuerySettings()->setStoragePageIds([$pageUid]);
        }else{
            $query->getQuerySettings()->setRespectStoragePage(false);
        }
        $query->matching(
            $query->logicalNot(
                // exclude test & admin-subforums
                $query->in('pid', [6189, 180])
            )
        );
        $query->setOrderings(['uid' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING]);
        $query->setLimit($limit);
        return $query->execute();
    }

    /**
     * @param FrontendUser $frontendUser
     * @return object|null
     */
    public function findUsersPosts(FrontendUser $frontendUser): QueryResultInterface
    {

        /** @var Typo3QuerySettings $querySettings */
        $query = $this->createQuery();

        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->matching($query->equals('frontenduser', $frontendUser));
        return $query->execute();
    }
}
