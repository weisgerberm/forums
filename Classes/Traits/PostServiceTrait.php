<?php

namespace Weisgerber\Forums\Traits;

use Weisgerber\Forums\Service\PostService;

trait PostServiceTrait
{
    protected ?PostService $postService = null;

    /**
     * @param \Weisgerber\Forums\Service\PostService|null $postService
     */
    public function injectPostService (?PostService $postService): void
    {
        $this->postService = $postService;
    }
}
