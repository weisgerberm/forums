<?php
defined('TYPO3') || die();
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

// Add the new doktype to the page type selector
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'pages',
    'doktype',
    [
        'label' => 'Subforum',
        'value' => \Weisgerber\Forums\Domain\Model\Page::PAGE_TYPE_SUBFORUM_CATEGORY,
        'icon'  => 'apps-pagetree-subforum-category',
        'group' => 'special',
    ],
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'pages',
    'doktype',
    [
        'label' => 'Subforum',
        'value' => \Weisgerber\Forums\Domain\Model\Page::PAGE_TYPE_SUBFORUM,
        'icon'  => 'apps-pagetree-subforum',
        'group' => 'special',
    ],
);

\TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
    $GLOBALS['TCA']['pages'],
    [
        // add icon for new page type:
        'ctrl' => [
            'typeicon_classes' => [
                \Weisgerber\Forums\Domain\Model\Page::PAGE_TYPE_SUBFORUM => 'apps-pagetree-subforum',
                \Weisgerber\Forums\Domain\Model\Page::PAGE_TYPE_SUBFORUM_CATEGORY => 'apps-pagetree-subforum-category',
            ],
        ],
        // add all page standard fields and tabs to your new page type
        'types' => [
            (string)\Weisgerber\Forums\Domain\Model\Page::PAGE_TYPE_SUBFORUM => [
                'showitem' => $GLOBALS['TCA']['pages']['types'][\TYPO3\CMS\Core\Domain\Repository\PageRepository::DOKTYPE_DEFAULT]['showitem'].', --div--;LLL:EXT:forums/Resources/Private/Language/locallang_tabs.xlf:extension-name, tx_forums_moderators',
            ],
            (string)\Weisgerber\Forums\Domain\Model\Page::PAGE_TYPE_SUBFORUM_CATEGORY => [
                'showitem' => $GLOBALS['TCA']['pages']['types'][\TYPO3\CMS\Core\Domain\Repository\PageRepository::DOKTYPE_DEFAULT]['showitem'],
            ],
        ],
    ]
);
$GLOBALS['TCA']['pages']['columns']['tx_forums_moderators'] = [
    'exclude' => true,
    'l10n_mode' => 'exclude',
    'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:moderators',
    'config' => [
        'type' => 'select',
        'renderType' => 'selectMultipleSideBySide',
        'size' => 7,
        'maxitems' => 20,
        'items' => [
        ],
        'exclusiveKeys' => '',
        'foreign_table' => 'fe_groups',
    ],
];
