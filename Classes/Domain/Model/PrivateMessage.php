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
 * PrivateMessage
 */
class PrivateMessage extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * subject
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $subject = '';

    /**
     * content
     *
     * @var string
     */
    protected $content = '';

    /**
     * sender
     *
     * @var \Weisgerber\Forums\Domain\Model\FrontendUser
     */
    protected $sender = null;

    /**
     * receiver
     *
     * @var \Weisgerber\Forums\Domain\Model\FrontendUser
     */
    protected $receiver = null;

    /**
     * Returns the subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Sets the subject
     *
     * @param string $subject
     * @return void
     */
    public function setSubject(string $subject)
    {
        $this->subject = $subject;
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
     * Returns the sender
     *
     * @return \Weisgerber\Forums\Domain\Model\FrontendUser
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Sets the sender
     *
     * @param \Weisgerber\Forums\Domain\Model\FrontendUser $sender
     * @return void
     */
    public function setSender(\Weisgerber\Forums\Domain\Model\FrontendUser $sender)
    {
        $this->sender = $sender;
    }

    /**
     * Returns the receiver
     *
     * @return \Weisgerber\Forums\Domain\Model\FrontendUser
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Sets the receiver
     *
     * @param \Weisgerber\Forums\Domain\Model\FrontendUser $receiver
     * @return void
     */
    public function setReceiver(\Weisgerber\Forums\Domain\Model\FrontendUser $receiver)
    {
        $this->receiver = $receiver;
    }
}
