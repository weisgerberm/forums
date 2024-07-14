<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Controller;

use Weisgerber\DarfIchMit\Domain\Model\Avatar;
use Weisgerber\DarfIchMit\Traits\AvatarRepositoryTrait;
use Weisgerber\Forums\Traits\{FrontendUserRepositoryTrait, FrontendUserServiceTrait};

/**
 * This file is part of the "Forums" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Mark Weisgerber <mark.weisgerber@outlook.de>
 */

/**
 * FrontendUserController
 */
class FrontendUserController extends AbstractController
{
    use FrontendUserRepositoryTrait;
    use FrontendUserServiceTrait;
    use AvatarRepositoryTrait;

    const PROFILE_SECTION_DASHBOARD = 'Dashboard';
    const PROFILE_SECTION_AVATAR = 'Avatar';

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $frontendUsers = $this->frontendUserRepository->findAll();
        $this->view->assign('frontendUsers', $frontendUsers);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \Weisgerber\Forums\Domain\Model\FrontendUser $frontendUser
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\Weisgerber\Forums\Domain\Model\FrontendUser $frontendUser): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action latest
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function latestAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action edit
     *
     * @param \Weisgerber\Forums\Domain\Model\FrontendUser $frontendUser
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("frontendUser")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\Weisgerber\Forums\Domain\Model\FrontendUser $frontendUser): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \Weisgerber\Forums\Domain\Model\FrontendUser $frontendUser
     */
    public function updateAction(\Weisgerber\Forums\Domain\Model\FrontendUser $frontendUser)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->frontendUserRepository->update($frontendUser);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Weisgerber\Forums\Domain\Model\FrontendUser $frontendUser
     */
    public function deleteAction(\Weisgerber\Forums\Domain\Model\FrontendUser $frontendUser)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->frontendUserRepository->remove($frontendUser);
        $this->redirect('list');
    }



}
