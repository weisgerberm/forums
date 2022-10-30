<?php
namespace Weisgerber\Forums\ViewHelpers;

use Closure;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use Weisgerber\Forums\Service\FrontendUserService;
use Weisgerber\Forums\Traits\FrontendUserServiceTrait;

class UserViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * Getting fe_user in VH-Context to avoid caching-issues
     *
     * @throws \TYPO3\CMS\Core\Context\Exception\AspectNotFoundException
     */
    public static function renderStatic(
        array $arguments,
        Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    )
    {

        /** @var \Weisgerber\Forums\Service\FrontendUserService $frontendUserService */
        $frontendUserService = GeneralUtility::makeInstance(FrontendUserService::class);

        $renderingContext->getVariableProvider()->add(
            'frontendUser',
            $frontendUserService->getLoggedInUser()
        );
        return '';
    }
}
