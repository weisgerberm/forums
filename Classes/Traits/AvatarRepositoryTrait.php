<?php

namespace Weisgerber\Forums\Traits;


trait AvatarRepositoryTrait
{
    protected \Weisgerber\Forums\Domain\Repository\AvatarRepository $avatarRepository;

    /**
     * @param \Weisgerber\Forums\Domain\Repository\AvatarRepository $avatarRepository
     */
    public function injectAvatarRepository(\Weisgerber\Forums\Domain\Repository\AvatarRepository $avatarRepository): void
    {
        $this->avatarRepository = $avatarRepository;
    }
}
