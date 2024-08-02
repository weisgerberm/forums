<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Domain\Model;


use Weisgerber\DarfIchMit\Domain\Model\Traits\FieldCrDate;
use Weisgerber\DarfIchMit\Domain\Model\Traits\FieldDescription;

class PostContent extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    public const string TABLE_NAME = 'tx_forums_domain_model_postcontent';

    use FieldCrDate;
    use FieldDescription {
        FieldDescription::setDescription as protected setDescriptionTrait;
    }

    protected ?Post $post = null;

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;
    }

    /**
     * Special rules: We only allow 3 new lines at once and the result is trimmed at the beginning and the end
     *
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = trim(preg_replace('/(\r\n|\r|\n){4,}/', "\n\n\n", $description));
    }


}
