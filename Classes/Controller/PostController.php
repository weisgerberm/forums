<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Controller;


use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Weisgerber\DarfIchMit\Domain\Model\Xp;
use Weisgerber\DarfIchMit\Traits\XpServiceTrait;
use Weisgerber\Forums\Domain\Model\{Post, Thread};
use Weisgerber\Forums\Domain\Repository\ThreadRepository;
use Weisgerber\Forums\Traits\PostRepositoryTrait;

class PostController extends \Weisgerber\DarfIchMit\Controller\AbstractController
{
    use PostRepositoryTrait;
    use XpServiceTrait;

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
     * @param Post $newPost
     * @throws AspectNotFoundException
     */
    #[IgnoreValidation(['argumentName' => 'thread'])]
    public function createAction(Post $newPost, Thread $thread): \Psr\Http\Message\ResponseInterface
    {
        $frontendUser = $this->fetchFeUser();
        if($frontendUser === null){
            \nn\t3::Http()->redirect( $this->settings['noPermission'] );
        }

        // Wir setzen selber den frontenduser und vertrauen nicht auf den fe-user aus dem Formular, weil dieser gefälscht sein könnte
        $newPost->setFrontenduser($frontendUser);
        $thread->addPost($newPost);

        /** @var ThreadRepository $threadRepository */
        $threadRepository = GeneralUtility::makeInstance(ThreadRepository::class);
        $threadRepository->update($thread);

        // XP gutschreiben
        $this->xpService->gain($frontendUser, 1, Xp::TYPE_FORUM_POST);

        \nn\t3::Message()->OK(
            "Danke für deinen Beitrag",
        "Du hast 1 XP verdient!");


        // Wieder zurück zum Thread springen
        return $this->redirect('show', 'Thread', null, ['thread' => $thread]);
    }

    /**
     * action edit
     *
     * @param Post $post
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("post")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(Post $post): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('post', $post);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param Post $post
     */
    public function updateAction(Post $post)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->postRepository->update($post);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param Post $post
     */
    public function deleteAction(Post $post)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->postRepository->remove($post);
        $this->redirect('list');
    }
}
