<?php
namespace Weisgerber\Forums\Controller;


use Weisgerber\DarfIchMit\Traits\FrontendUserServiceTrait;

class AbstractController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    use FrontendUserServiceTrait;

    protected function initializeView()
    {
        $this->view->assign('frontendUser', $this->frontendUserService->getLoggedInUser());
    }
}
