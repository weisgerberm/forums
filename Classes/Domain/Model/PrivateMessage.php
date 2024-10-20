<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Domain\Model;


use Weisgerber\DarfIchMit\Domain\Model\FrontendUser;

class PrivateMessage extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    public const string TABLE_NAME = 'tx_forums_domain_model_privatemessage';

    /**
     * subject
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected string $subject = '';

    /**
     * content
     *
     * @var string
     */
    protected string $content = '';

    /**
     * sender
     *
     * @var FrontendUser
     */
    protected ?FrontendUser $sender = null;

    /**
     * receiver
     *
     * @var FrontendUser
     */
    protected ?FrontendUser $receiver = null;

    /**
     * Returns the subject
     *
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * Sets the subject
     *
     * @param string $subject
     * @return void
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * Returns the content
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Sets the content
     *
     * @param string $content
     * @return void
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Returns the sender
     *
     * @return FrontendUser
     */
    public function getSender(): ?FrontendUser
    {
        return $this->sender;
    }

    /**
     * Sets the sender
     *
     * @param FrontendUser $sender
     * @return void
     */
    public function setSender(FrontendUser $sender): void
    {
        $this->sender = $sender;
    }

    /**
     * Returns the receiver
     *
     * @return FrontendUser
     */
    public function getReceiver(): ?FrontendUser
    {
        return $this->receiver;
    }

    /**
     * Sets the receiver
     *
     * @param FrontendUser $receiver
     * @return void
     */
    public function setReceiver(FrontendUser $receiver): void
    {
        $this->receiver = $receiver;
    }
}
