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
 * PostReport
 */
class PostReport extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * description
     *
     * @var string
     */
    protected $description = '';

    /**
     * postReference
     *
     * @var \Weisgerber\Forums\Domain\Model\Post
     */
    protected $postReference = null;

    /**
     * frontendUser
     *
     * @var \Weisgerber\Forums\Domain\Model\FrontendUser
     */
    protected $frontendUser = null;

    /**
     * Returns the description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Returns the postReference
     *
     * @return \Weisgerber\Forums\Domain\Model\Post
     */
    public function getPostReference()
    {
        return $this->postReference;
    }

    /**
     * Sets the postReference
     *
     * @param \Weisgerber\Forums\Domain\Model\Post $postReference
     * @return void
     */
    public function setPostReference(\Weisgerber\Forums\Domain\Model\Post $postReference)
    {
        $this->postReference = $postReference;
    }

    /**
     * Returns the frontendUser
     *
     * @return \Weisgerber\Forums\Domain\Model\FrontendUser
     */
    public function getFrontendUser()
    {
        return $this->frontendUser;
    }

    /**
     * Sets the frontendUser
     *
     * @param \Weisgerber\Forums\Domain\Model\FrontendUser $frontendUser
     * @return void
     */
    public function setFrontendUser(\Weisgerber\Forums\Domain\Model\FrontendUser $frontendUser)
    {
        $this->frontendUser = $frontendUser;
    }
}
