<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Controller;


use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;/**
 * This file is part of the "Forums" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2022 Mark Weisgerber <mark.weisgerber@outlook.de>
 */

/**
 * TagController
 */
class TagController extends AbstractController
{

    /**
     * tagRepository
     *
     * @var \Weisgerber\Forums\Domain\Repository\TagRepository
     */
    protected $tagRepository = null;

    /**
     * @param \Weisgerber\Forums\Domain\Repository\TagRepository $tagRepository
     */
    public function injectTagRepository(\Weisgerber\Forums\Domain\Repository\TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
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
     * @param \Weisgerber\Forums\Domain\Model\Tag $newTag
     */
    public function createAction(\Weisgerber\Forums\Domain\Model\Tag $newTag)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', ContextualFeedbackSeverity::WARNING);
        $this->tagRepository->add($newTag);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Weisgerber\Forums\Domain\Model\Tag $tag
     */
    public function deleteAction(\Weisgerber\Forums\Domain\Model\Tag $tag)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', ContextualFeedbackSeverity::WARNING);
        $this->tagRepository->remove($tag);
        $this->redirect('list');
    }
}
