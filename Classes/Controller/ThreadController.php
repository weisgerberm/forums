<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;
use Weisgerber\DarfIchMit\Traits\FrontendUserServiceTrait;
use Weisgerber\DarfIchMit\Traits\SlugServiceTrait;
use Weisgerber\DarfIchMit\Utility\DimUtility;
use Weisgerber\Forums\Domain\Model\Thread;
use Weisgerber\Forums\Service\UriService;
use Weisgerber\Forums\Traits\{ThreadRepositoryTrait, ThreadServiceTrait, UriServiceTrait};

/**
 * This file is part of the "forums" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Mark Weisgerber <mark.weisgerber@outlook.de>
 */

/**
 * ThreadController
 */
class ThreadController extends \Weisgerber\DarfIchMit\Controller\AbstractController
{
    use SlugServiceTrait;
    use ThreadRepositoryTrait;
    use FrontendUserServiceTrait;
    use ThreadServiceTrait;
    use UriServiceTrait;

    /**
     * action list
     *
     * @param int $page
     * @return ResponseInterface
     */
    public function listAction(int $page = 1): ResponseInterface
    {
        $threads = $this->threadRepository->findAll();

        /** @var \TYPO3\CMS\Extbase\Pagination\QueryResultPaginator $paginator */
        $paginator = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Pagination\QueryResultPaginator::class, $threads,$page,10);
        /** @var \TYPO3\CMS\Core\Pagination\SimplePagination $pagination */
        $pagination = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Pagination\SimplePagination::class,$paginator);
        $this->view->assignMultiple(
            [
                'threads' => $paginator->getPaginatedItems(),
                'pagination' => $pagination
            ]
        );
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param Thread $thread
     * @return ResponseInterface
     */
    #[IgnoreValidation(['argumentName' => 'thread'])]
    public function showAction(Thread $thread, int $currentPage = 1): ResponseInterface
    {
        $this->fetchFeUser();
        $this->view->assign('thread', $thread);
        return $this->htmlResponse();
    }

    /**
     * action new
     *
     * @return ResponseInterface
     */
    public function newAction(): ResponseInterface
    {
        $frontendUser = $this->frontendUserService->getLoggedInUser();
        if(is_null($frontendUser)){
            return $this->uriService->reloadWithStatus( UriService::HTTP_FORBIDDEN);
        }
        return $this->htmlResponse();
    }

    /**
     * action create
     *
     * @param Thread $newThread
     */
    public function createAction(Thread $newThread): ResponseInterface
    {
        $this->threadRepository->add($newThread);

        DimUtility::persistAll();
        /** @var Thread $record */
        $record = $this->threadRepository->findByUidAssoc($newThread->getUid());

        $this->threadService->postProcessing($newThread);

        $newThread->setPathSegment($this->slugService->getSlug($newThread->jsonSerialize(), Thread::TABLE_NAME));
        $this->threadRepository->update($newThread);

        // Sodass die URL schon korrekt aufgelöst werden kann bei der Weiterleitung
        DimUtility::persistAll();

        return $this->redirect('show', null, null, ['thread' => $newThread]);
    }

    /**
     * action edit
     *
     * @param Thread $thread
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("thread")
     * @return ResponseInterface
     */
    public function editAction(Thread $thread): ResponseInterface
    {
        $this->view->assign('thread', $thread);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param Thread $thread
     */
    public function updateAction(Thread $thread)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->threadRepository->update($thread);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param Thread $thread
     */
    public function deleteAction(Thread $thread)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->threadRepository->remove($thread);
        $this->redirect('list');
    }

    /**
     * action lock
     *
     * @return ResponseInterface
     */
    public function lockAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action rss
     *
     * @return ResponseInterface
     */
    public function rssAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }
}
