<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Domain\Model;


use Weisgerber\DarfIchMit\Domain\Model\Traits\FieldCrDate;
use Weisgerber\DarfIchMit\Domain\Model\Traits\FieldDescription;

class PostContent extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    public const string TABLE_NAME = 'tx_forums_domain_model_postcontent';

    use FieldCrDate;
    use FieldDescription;

    protected ?Post $post = null;

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;
    }

}
