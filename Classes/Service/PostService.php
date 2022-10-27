<?php

namespace Weisgerber\Forums\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Weisgerber\Forums\Domain\Model\Post;
use Weisgerber\Forums\Domain\Model\Thread;
use Weisgerber\Forums\Repository\Traits\ThreadRepositoryTrait;

class PostService
{
    /**
     * @param array $form
     * @return \Weisgerber\Forums\Domain\Model\Post
     */
    public function createPost(array $form):Post
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
}
