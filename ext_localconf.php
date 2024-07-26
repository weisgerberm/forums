<?php

use Weisgerber\Forums\Controller\{FrontendUserController, PageController, PostController, ThreadController};

defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Forums',
        'Show',
        [
            ThreadController::class => 'list, show, new, create, edit, update, delete',
            FrontendUserController::class => 'show, latest',
            PostController::class => 'new, create, edit, update, delete'
        ],
        // non-cacheable actions
        [
            ThreadController::class => 'list, show, new, create, edit, update, delete',
            FrontendUserController::class => 'show, latest',
            PostController::class => 'new, create, edit, update, delete'
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Forums',
        'Subforum',
        [
            PageController::class => 'subforum'
        ],
        // non-cacheable actions
        [
            PageController::class => 'subforum'
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Forums',
        'Subforums',
        [
            PageController::class => 'subforums'
        ],
        // non-cacheable actions
        [
            PageController::class => 'subforums'
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Forums',
        'Latestposts',
        [
            PostController::class => 'latest'
        ],
        // non-cacheable actions
        [
            PostController::class => 'latest'
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Forums',
        'Latestthreads',
        [
            ThreadController::class => 'latest'
        ],
        // non-cacheable actions
        [
            ThreadController::class => 'latest'
        ]
    );

    // Provide icon for page tree, list view, ... :
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class)
        ->registerIcon(
            'apps-pagetree-subforum',
            TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            [
                'source' => 'EXT:forums/Resources/Public/Icons/doktype-95.svg',
            ]
        );
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class)
        ->registerIcon(
            'apps-pagetree-subforum-category',
            TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            [
                'source' => 'EXT:forums/Resources/Public/Icons/doktype-96.svg',
            ]
        );


    // Allow backend users to drag and drop the new page type:
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig(
        'options.pageTree.doktypesToShowInNewPageDragArea := addToList(' . \Weisgerber\Forums\Domain\Model\Page::PAGE_TYPE_SUBFORUM . ',' . \Weisgerber\Forums\Domain\Model\Page::PAGE_TYPE_SUBFORUM_CATEGORY . ')'
    );

    // Make ViewHelpers globally available
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['forums'][] = 'Weisgerber\Forums\ViewHelpers';
})();
