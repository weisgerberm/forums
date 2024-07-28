<?php

namespace Weisgerber\Forums\Domain\Model\DTO;

use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;
use Weisgerber\DarfIchMit\Domain\Model\DTO\AbstractDTO;
use Weisgerber\DarfIchMit\Domain\Model\Traits\FieldDescription;
use Weisgerber\Forums\Domain\Model\Post;

class EditPostDTO extends AbstractDTO
{
    use FieldDescription;

    protected Post $post;

    public function getPost(): Post
    {
        return $this->post;
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;
    }
}
