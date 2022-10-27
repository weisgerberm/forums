<?php

namespace Weisgerber\Forums\Repository\Traits;


trait ThreadRepositoryTrait
{
    protected \Weisgerber\Forums\Domain\Repository\ThreadRepository $threadRepository;

    /**
     * @param \Weisgerber\Forums\Domain\Repository\ThreadRepository $threadRepository
     */
    public function injectThreadRepository(\Weisgerber\Forums\Domain\Repository\ThreadRepository $threadRepository): void
    {
        $this->threadRepository = $threadRepository;
    }
}
