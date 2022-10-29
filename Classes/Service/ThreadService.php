<?php

namespace Weisgerber\Forums\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Weisgerber\Forums\Domain\Model\Post;
use Weisgerber\Forums\Domain\Model\Thread;
use Weisgerber\Forums\Traits\{ThreadRepositoryTrait,FrontendUserServiceTrait};

class ThreadService
{
    use ThreadRepositoryTrait;
    use FrontendUserServiceTrait;

    /**
     * @param array $form
     * @return \Weisgerber\Forums\Domain\Model\Thread
     */
    public function createThreadByForm(array $form):Thread
    {
        if(isset($form['form-content'])){
            $thread = GeneralUtility::makeInstance(Thread::class);
            $thread->setHeadline($form['headline']);
            $post = GeneralUtility::makeInstance(Post::class);
            $post->addPostContent();
            $thread->addPost($post);
        }else{
            die("MIS");
        }
    }

    /**
     * Post-processing after creating entity from form submit
     * @param \Weisgerber\Forums\Domain\Model\Thread $newThread
     *
     * @return void
     */
    public function postProcessing (Thread $newThread)
    {
        $newThread->getFirstPost()->setFrontenduser($this->frontendUserService->getLoggedInUser());
    }
}
