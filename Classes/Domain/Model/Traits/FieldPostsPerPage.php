<?php

namespace Weisgerber\Forums\Domain\Model\Traits;

/**
 * The number of posts per page for the forum
 * */
trait FieldPostsPerPage
{
    protected int $postsPerPage = 0;

    public function getPostsPerPage(): int
    {
        return $this->postsPerPage;
    }

    public function setPostsPerPage(int $postsPerPage): void
    {
        $this->postsPerPage = max(5, min(35, $postsPerPage));
    }

}
