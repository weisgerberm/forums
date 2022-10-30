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
 * PollOptionController
 */
class PollOptionController extends AbstractController
{

    /**
     * pollOptionRepository
     *
     * @var \Weisgerber\Forums\Domain\Repository\PollOptionRepository
     */
    protected $pollOptionRepository = null;

    /**
     * @param \Weisgerber\Forums\Domain\Repository\PollOptionRepository $pollOptionRepository
     */
    public function injectPollOptionRepository(\Weisgerber\Forums\Domain\Repository\PollOptionRepository $pollOptionRepository)
    {
        $this->pollOptionRepository = $pollOptionRepository;
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
     * @param \Weisgerber\Forums\Domain\Model\PollOption $newPollOption
     */
    public function createAction(\Weisgerber\Forums\Domain\Model\PollOption $newPollOption)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->pollOptionRepository->add($newPollOption);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Weisgerber\Forums\Domain\Model\PollOption $pollOption
     */
    public function deleteAction(\Weisgerber\Forums\Domain\Model\PollOption $pollOption)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->pollOptionRepository->remove($pollOption);
        $this->redirect('list');
    }
}
