<?php

namespace Weisgerber\Forums\Service;

use TYPO3\CMS\Core\Http\RedirectResponse;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;


class UriService extends AbstractService
{
    // [Successful 2xx]
    const HTTP_OK = 200;
    // [Redirection 3xx]
    const HTTP_MULTIPLE_CHOICES = 300;
    const HTTP_MOVED_PERMANENTLY = 301;
    const HTTP_FOUND = 302;
    const HTTP_TEMPORARY_REDIRECT = 307;
    // [Client Error 4xx]
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    // [Server Error 5xx]
    const HTTP_INTERNAL_SERVER_ERROR = 500;

    /**
     * @param $uri
     * @param $status
     *
     * @return \TYPO3\CMS\Core\Http\RedirectResponse
     */
    public function redirect($uri, $status = 200):RedirectResponse
    {
        return new RedirectResponse($uri,$status);
    }

    public function redirectToPage($pageUid, $status = 200):RedirectResponse
    {
        $uriBuilder = $this->objectManager->get(\TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder::class);
        $uriBuilder->setTargetPageUid($pageUid);
        return $this->redirect($uriBuilder->buildFrontendUri(), $status);
    }

    public function reloadWithStatus($status = 200):RedirectResponse
    {
        return $this->redirect('https://google.de', $status);
    }
}
