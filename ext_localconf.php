<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Forums',
        'Show',
        [
            \Weisgerber\Forums\Controller\ThreadController::class => 'list, show, new, create, edit, update, delete',
            \Weisgerber\Forums\Controller\FrontendUserController::class => 'show, latest',
            \Weisgerber\Forums\Controller\PostController::class => 'new, create, edit, update, delete'
        ],
        // non-cacheable actions
        [
            \Weisgerber\Forums\Controller\ThreadController::class => 'list, show, new, create, edit, update, delete',
            \Weisgerber\Forums\Controller\FrontendUserController::class => 'show, latest',
            \Weisgerber\Forums\Controller\PostController::class => 'new, create, edit, update, delete'
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Forums',
        'Subforums',
        [
            \Weisgerber\Forums\Controller\PageController::class => 'subforums'
        ],
        // non-cacheable actions
        [
            \Weisgerber\Forums\Controller\PageController::class => 'subforums'
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Forums',
        'Profile',
        [
            \Weisgerber\Forums\Controller\FrontendUserController::class => 'profile, show, latest'
        ],
        // non-cacheable actions
        [
            \Weisgerber\Forums\Controller\FrontendUserController::class => 'profile, show, latest'
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Forums',
        'Latestposts',
        [
            \Weisgerber\Forums\Controller\PostController::class => 'latest'
        ],
        // non-cacheable actions
        [
            \Weisgerber\Forums\Controller\PostController::class => 'latest'
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Forums',
        'Latestthreads',
        [
            \Weisgerber\Forums\Controller\ThreadController::class => 'latest'
        ],
        // non-cacheable actions
        [
            \Weisgerber\Forums\Controller\ThreadController::class => 'latest'
        ]
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    show {
                        iconIdentifier = forums-plugin-show
                        title = LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_show.name
                        description = LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_show.description
                        tt_content_defValues {
                            CType = list
                            list_type = forums_show
                        }
                    }
                    subforums {
                        iconIdentifier = forums-plugin-subforums
                        title = LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_subforums.name
                        description = LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_subforums.description
                        tt_content_defValues {
                            CType = list
                            list_type = forums_subforums
                        }
                    }
                    profile {
                        iconIdentifier = forums-plugin-profile
                        title = LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_profile.name
                        description = LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_profile.description
                        tt_content_defValues {
                            CType = list
                            list_type = forums_profile
                        }
                    }
                    latestposts {
                        iconIdentifier = forums-plugin-latestposts
                        title = LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_latestposts.name
                        description = LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_latestposts.description
                        tt_content_defValues {
                            CType = list
                            list_type = forums_latestposts
                        }
                    }
                    latestthreads {
                        iconIdentifier = forums-plugin-latestthreads
                        title = LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_latestthreads.name
                        description = LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_latestthreads.description
                        tt_content_defValues {
                            CType = list
                            list_type = forums_latestthreads
                        }
                    }
                }
                show = *
            }
       }'
    );
})();
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

call_user_func(
    function () {

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
    }

);