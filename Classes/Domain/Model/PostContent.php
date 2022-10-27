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
 * PostContent
 */
class PostContent extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * @var \DateTime|null
     */
    protected $crdate = null;

    /**
     * headline
     *
     * @var string
     */
    protected $headline = '';

    /**
     * content
     *
     * @var string
     */
    protected $content = '';

    /**
     * Returns the headline
     *
     * @return string
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Sets the headline
     *
     * @param string $headline
     * @return void
     */
    public function setHeadline(string $headline)
    {
        $this->headline = $headline;
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

    /**
     * @return \DateTime|null
     */
    public function getCrdate()
    {
        return $this->crdate;
    }

    /**
     * @param ?\DateTime $crdate
     */
    public function setCrdate(?\DateTime $crdate)
    {
        $this->crdate = $crdate;
    }
}
