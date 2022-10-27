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
 * Avatar
 */
class Avatar extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * image
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $image = null;

    /**
     * custom
     *
     * @var bool
     */
    protected $custom = false;

    /**
     * Returns the image
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        $this->image = $image;
    }

    /**
     * Returns the custom
     *
     * @return bool
     */
    public function getCustom()
    {
        return $this->custom;
    }

    /**
     * Sets the custom
     *
     * @param bool $custom
     * @return void
     */
    public function setCustom(bool $custom)
    {
        $this->custom = $custom;
    }

    /**
     * Returns the boolean state of custom
     *
     * @return bool
     */
    public function isCustom()
    {
        return $this->custom;
    }
}
