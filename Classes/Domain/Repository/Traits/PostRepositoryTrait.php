<?php

namespace Weisgerber\Forums\Repository\Traits;


trait PostRepositoryTrait
{
    protected \Weisgerber\Forums\Domain\Repository\PostRepository $postRepository;

    /**
     * @param \Weisgerber\Forums\Domain\Repository\PostRepository $postRepository
     */
    public function injectPostRepository(\Weisgerber\Forums\Domain\Repository\PostRepository $postRepository): void
    {
        $this->postRepository = $postRepository;
    }
}
