<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Domain\Model;


use Weisgerber\DarfIchMit\Domain\Model\Traits\FieldFrontenduser;/**
 * This file is part of the "Forums" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2022 Mark Weisgerber <mark.weisgerber@outlook.de>
 */

/**
 * PostLike
 */
class PostLike extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    use FieldFrontenduser;

    public const string TABLE_NAME = 'tx_forums_domain_model_postlike';

}
