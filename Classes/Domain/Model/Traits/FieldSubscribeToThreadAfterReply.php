<?php

namespace Weisgerber\Forums\Domain\Model\Traits;

/**
 * The field contains a flag whether a user gets notifications for new replies
 */
trait FieldSubscribeToThreadAfterReply
{
    protected bool $subscribeToThreadAfterReply = true;

    public function getSubscribeToThreadAfterReply(): bool
    {
        return $this->subscribeToThreadAfterReply;
    }

    public function setSubscribeToThreadAfterReply(bool $subscribeToThreadAfterReply): void
    {
        $this->subscribeToThreadAfterReply = $subscribeToThreadAfterReply;
    }
}
