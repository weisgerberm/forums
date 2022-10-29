<?php

declare(strict_types=1);

namespace Weisgerber\Forums\Controller;

use Weisgerber\Forums\Traits\PageServiceTrait;

/**
 * This file is part of the "Forums" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Mark Weisgerber <mark.weisgerber@outlook.de>
 */

/**
 * PageController
 */
class PageController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    use PageServiceTrait;

    /**
     * Fetches all subforums of the current page, where this plugin belongs to
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function subforumsAction(): \Psr\Http\Message\ResponseInterface
    {
        $categoryPages = $this->pageService->getSubforumsAndPrefillThem();
        $this->view->assignMultiple([
           'categoryPages' => $categoryPages
        ]);
        return $this->htmlResponse();
    }
}
