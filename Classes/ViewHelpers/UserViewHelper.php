<?php
namespace Weisgerber\Forums\ViewHelpers;

use Closure;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use Weisgerber\Forums\Service\Traits\FrontendUserServiceTrait;

class UserViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;
    use FrontendUserServiceTrait;

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

        $userRepository = GeneralUtility::makeInstance(FrontendUserRepository::class);
        $context = GeneralUtility::makeInstance(Context::class);
        $userId = $context->getPropertyFromAspect('frontend.user', 'id');


        $renderingContext->getVariableProvider()->add(
            'frontendUser',
            $userRepository->findByUid($userId)
        );
        return '';
    }
}
