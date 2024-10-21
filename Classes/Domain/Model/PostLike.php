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
 * PostLike
 */
class PostLike extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    public const string TABLE_NAME = 'tx_forums_domain_model_postlike';
    /**
     * frontendUser
     *
     * @var \Weisgerber\DarfIchMit\Domain\Model\FrontendUser
     */
    protected $frontendUser = null;

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
}
