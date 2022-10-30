<?php
namespace Weisgerber\Forums\Controller;

use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use Weisgerber\Forums\Traits\FrontendUserServiceTrait;

class AbstractController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    use FrontendUserServiceTrait;

    protected function initializeView(ViewInterface $view)
    {
        $this->view->assign('frontendUser', $this->frontendUserService->getLoggedInUser());
    }
}
