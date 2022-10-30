<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Controller;


/**
 * This file is part of the "Forums" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Mark Weisgerber <mark.weisgerber@outlook.de>
 */

/**
 * PostLikeController
 */
class PostLikeController extends AbstractController
{

    /**
     * postLikeRepository
     *
     * @var \Weisgerber\Forums\Domain\Repository\PostLikeRepository
     */
    protected $postLikeRepository = null;

    /**
     * @param \Weisgerber\Forums\Domain\Repository\PostLikeRepository $postLikeRepository
     */
    public function injectPostLikeRepository(\Weisgerber\Forums\Domain\Repository\PostLikeRepository $postLikeRepository)
    {
        $this->postLikeRepository = $postLikeRepository;
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
     * @param \Weisgerber\Forums\Domain\Model\PostLike $newPostLike
     */
    public function createAction(\Weisgerber\Forums\Domain\Model\PostLike $newPostLike)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->postLikeRepository->add($newPostLike);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Weisgerber\Forums\Domain\Model\PostLike $postLike
     */
    public function deleteAction(\Weisgerber\Forums\Domain\Model\PostLike $postLike)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->postLikeRepository->remove($postLike);
        $this->redirect('list');
    }
}
