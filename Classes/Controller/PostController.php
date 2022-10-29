<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Controller;


use Weisgerber\Forums\Traits\PostRepositoryTrait;

/**
 * This file is part of the "Forums" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Mark Weisgerber <mark.weisgerber@outlook.de>
 */

/**
 * PostController
 */
class PostController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    use PostRepositoryTrait;

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function latestAction(): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assignMultiple([
            'posts' => $this->postRepository->findLatestAmount()
        ]);
        return $this->htmlResponse();
    }

    /**
     * action new
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function newAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action create
     *
     * @param \Weisgerber\Forums\Domain\Model\Post $newPost
     */
    public function createAction(\Weisgerber\Forums\Domain\Model\Post $newPost)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->postRepository->add($newPost);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Weisgerber\Forums\Domain\Model\Post $post
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("post")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\Weisgerber\Forums\Domain\Model\Post $post): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('post', $post);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \Weisgerber\Forums\Domain\Model\Post $post
     */
    public function updateAction(\Weisgerber\Forums\Domain\Model\Post $post)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->postRepository->update($post);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Weisgerber\Forums\Domain\Model\Post $post
     */
    public function deleteAction(\Weisgerber\Forums\Domain\Model\Post $post)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->postRepository->remove($post);
        $this->redirect('list');
    }
}
