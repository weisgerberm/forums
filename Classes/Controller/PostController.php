<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Controller;


use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Weisgerber\DarfIchMit\Domain\Model\Xp;
use Weisgerber\DarfIchMit\Traits\XpServiceTrait;
use Weisgerber\Forums\Domain\Model\{DTO\EditPostDTO, Post, PostContent, Thread};
use Weisgerber\DarfIchMit\Utility\DimUtility;
use Weisgerber\DarfIchMit\Utility\DTOUtility;
use Weisgerber\Forums\Domain\Repository\ThreadRepository;
use Weisgerber\Forums\Traits\PostRepositoryTrait;

class PostController extends \Weisgerber\DarfIchMit\Controller\AbstractController
{
    use PostRepositoryTrait;
    use XpServiceTrait;

    /**
     * @return ResponseInterface
     */
    public function latestAction(): ResponseInterface
    {
        $this->view->assignMultiple([
            'posts' => $this->postRepository->findLatestAmount()
        ]);
        return $this->htmlResponse();
    }

    /**
     * action create
     *
     * @param Post $newPost
     * @throws AspectNotFoundException
     */
    #[IgnoreValidation(['argumentName' => 'thread'])]
    public function createAction(Post $newPost, Thread $thread): ResponseInterface
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
     * Displays the edit form for a post
     *
     * @param Post $post
     * @return ResponseInterface
     */
    #[IgnoreValidation(['argumentName' => 'post'])]
    public function editAction(Post $post): ResponseInterface
    {
        $frontendUser = $this->frontendUserService->getLoggedInUser();
        if($frontendUser === null || $post->getFrontenduser() !== $frontendUser){
            \nn\t3::Http()->redirect( $this->settings['noPermission'] );

        }

        $this->view->assign('post', $post);
        return $this->htmlResponse();
    }

    /**
     * Updates a post but only accepts a DTO for security reasons
     *
     * @param Post $editPostDTO
     */
    #[IgnoreValidation(['argumentName' => 'editPostDTO'])]
    public function updateAction(EditPostDTO $editPostDTO): ResponseInterface
    {
        $frontendUser = $this->frontendUserService->getLoggedInUser();
        if($frontendUser === null){
            \nn\t3::Http()->redirect( $this->settings['noPermission'] );

        }
        /** @var PostContent $postContent */
        $postContent = GeneralUtility::makeInstance(PostContent::class);
        $postContent->setPid($editPostDTO->getPost()->getPid());
        $postContent->setDescription($editPostDTO->getDescription());
        $postContent->setPost($editPostDTO->getPost());

        $editPostDTO->getPost()->addPostContent($postContent);


        $this->postRepository->update($editPostDTO->getPost());

        return $this->redirect('show', 'Thread', null, ['thread' => $editPostDTO->getPost()->getThread()]);
    }

    /**
     * action delete
     *
     * @param Post $post
     */
    #[IgnoreValidation(['argumentName' => 'post'])]
    public function deleteAction(Post $post): ResponseInterface
    {
        $frontendUser = $this->frontendUserService->getLoggedInUser();

        if($frontendUser === $post->getFrontenduser()){
            $post->setSoftDeleted(true);
            $this->postRepository->update($post);
            DimUtility::persistAll();
            \nn\t3::Message()->OK(
                "Dein Beitrag wurde gelöscht",
                "Wenn du es dir anders überlegst, kannst du ihn einfach wiederherstellen.");
        }else{
            \nn\t3::Message()->ERROR(
                "Der Beitrag wurde nicht gelöscht",
                "Dieser Beitrag gehört nicht dir!");
        }


        return $this->redirect('show', 'Thread', null, ['thread' => $post->getThread()]);
    }

    /**
     * action recover
     *
     * @param Post $post
     */
    #[IgnoreValidation(['argumentName' => 'post'])]
    public function restoreAction(Post $post): ResponseInterface
    {
        $frontendUser = $this->frontendUserService->getLoggedInUser();

        if($frontendUser === $post->getFrontenduser()){
            $post->setSoftDeleted(false);
            $this->postRepository->update($post);
            DimUtility::persistAll();
            \nn\t3::Message()->OK(
                "Dein Beitrag wurde wiederhergestellt",
                "Schön, dass du es dir anders überlegt hast. ");
        }else{
            \nn\t3::Message()->ERROR(
                "Der Beitrag wurde nicht wiederhergestellt",
                "Dieser Beitrag gehört nicht dir!");
        }


        return $this->redirect('show', 'Thread', null, ['thread' => $post->getThread()]);
    }
}
