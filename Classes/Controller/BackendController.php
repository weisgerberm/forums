<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Controller;

use Psr\Http\Message\ResponseInterface;
use Weisgerber\DarfIchMit\Controller\AbstractBackendController;
use Weisgerber\DarfIchMit\Traits\ModuleTemplateServiceTrait;

class BackendController extends AbstractBackendController
{
    use ModuleTemplateServiceTrait;

    /**
     * Backend view status
     */
    public function statusAction(): ResponseInterface
    {

        return $this->htmlResponse($this->createBackendView());
    }

    /**
     * Create a thread for news-records
     */
    public function newsAction(): ResponseInterface
    {

        return $this->htmlResponse($this->createBackendView());
    }
}
