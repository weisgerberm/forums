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
 * PrivateMessageController
 */
class PrivateMessageController extends AbstractController
{

    /**
     * privateMessageRepository
     *
     * @var \Weisgerber\Forums\Domain\Repository\PrivateMessageRepository
     */
    protected $privateMessageRepository = null;

    /**
     * @param \Weisgerber\Forums\Domain\Repository\PrivateMessageRepository $privateMessageRepository
     */
    public function injectPrivateMessageRepository(\Weisgerber\Forums\Domain\Repository\PrivateMessageRepository $privateMessageRepository)
    {
        $this->privateMessageRepository = $privateMessageRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $privateMessages = $this->privateMessageRepository->findAll();
        $this->view->assign('privateMessages', $privateMessages);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \Weisgerber\Forums\Domain\Model\PrivateMessage $privateMessage
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\Weisgerber\Forums\Domain\Model\PrivateMessage $privateMessage): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('privateMessage', $privateMessage);
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
     * @param \Weisgerber\Forums\Domain\Model\PrivateMessage $newPrivateMessage
     */
    public function createAction(\Weisgerber\Forums\Domain\Model\PrivateMessage $newPrivateMessage)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->privateMessageRepository->add($newPrivateMessage);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Weisgerber\Forums\Domain\Model\PrivateMessage $privateMessage
     */
    public function deleteAction(\Weisgerber\Forums\Domain\Model\PrivateMessage $privateMessage)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->privateMessageRepository->remove($privateMessage);
        $this->redirect('list');
    }
}
