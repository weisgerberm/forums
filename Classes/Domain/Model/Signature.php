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
 * Signature
 */
class Signature extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * activated
     *
     * @var bool
     */
    protected $activated = false;

    /**
     * content
     *
     * @var string
     */
    protected $content = '';

    /**
     * Returns the activated
     *
     * @return bool
     */
    public function getActivated()
    {
        return $this->activated;
    }

    /**
     * Sets the activated
     *
     * @param bool $activated
     * @return void
     */
    public function setActivated(bool $activated)
    {
        $this->activated = $activated;
    }

    /**
     * Returns the boolean state of activated
     *
     * @return bool
     */
    public function isActivated()
    {
        return $this->activated;
    }

    /**
     * Returns the content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets the content
     *
     * @param string $content
     * @return void
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }
}
