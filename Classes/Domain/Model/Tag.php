<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Domain\Model;

class Tag extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    public const string TABLE_NAME = 'tx_forums_domain_model_tag';
    /**
     * title
     *
     * @var string
     */
    protected string $title = '';

    /**
     * Returns the title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
