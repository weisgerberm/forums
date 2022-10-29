<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Weisgerber\Forums\Domain\Model\Thread;
use Weisgerber\Forums\Service\UriService;
use Weisgerber\Forums\Traits\{SlugServiceTrait,ThreadRepositoryTrait,FrontendUserServiceTrait,ThreadServiceTrait,UriServiceTrait};

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
class ThreadController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    use SlugServiceTrait;
    use ThreadRepositoryTrait;
    use FrontendUserServiceTrait;
    use ThreadServiceTrait;
    use UriServiceTrait;

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $threads = $this->threadRepository->findAll();

        $this->view->assign('threads', $threads);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \Weisgerber\Forums\Domain\Model\Thread $thread
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\Weisgerber\Forums\Domain\Model\Thread $thread): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('thread', $thread);
        return $this->htmlResponse();
    }

    /**
     * action new
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function newAction(): \Psr\Http\Message\ResponseInterface
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
    public function createAction(Thread $newThread)
    {

        $this->threadRepository->add($newThread);

        GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager::class)->persistAll();
        /** @var Thread $record */
        $record = $this->threadRepository->findByUidAssoc($newThread->getUid());

        $this->threadService->postProcessing($newThread);

        $newThread->setSlug($this->slugService->getSlug($record,'thread'));
        $this->threadRepository->update($newThread);



        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Weisgerber\Forums\Domain\Model\Thread $thread
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("thread")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\Weisgerber\Forums\Domain\Model\Thread $thread): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('thread', $thread);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \Weisgerber\Forums\Domain\Model\Thread $thread
     */
    public function updateAction(\Weisgerber\Forums\Domain\Model\Thread $thread)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->threadRepository->update($thread);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Weisgerber\Forums\Domain\Model\Thread $thread
     */
    public function deleteAction(\Weisgerber\Forums\Domain\Model\Thread $thread)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->threadRepository->remove($thread);
        $this->redirect('list');
    }

    /**
     * action lock
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function lockAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action rss
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function rssAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }
}
