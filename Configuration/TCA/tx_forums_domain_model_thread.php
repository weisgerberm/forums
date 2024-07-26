<?php

use Weisgerber\DarfIchMit\Utility\TcaUtility;
use Weisgerber\Forums\Domain\Model\Thread;

return [
    'ctrl' => TcaUtility::getController(Thread::TABLE_NAME,'forums', [
        'sortby' => 'sorting',
    ], false),
    'types' => [
        '1' => ['showitem' => TcaUtility::tab(null, ['title','closed','cached_counter_posts','cached_counter_views','sticky','slug','files','posts','tags','active_users']).
            TcaUtility::finishTabs()],
    ],
    'columns' => \nn\t3::TCA()->createConfig(
        Thread::TABLE_NAME,
        ['hidden'],
        [
            'categories' => TcaUtility::getCategory('1'),
            'path_segment' => TcaUtility::getFieldPathSegment(),
            'title' => [
                'exclude' => true,
                'label' => TcaUtility::title('title'),
                'config' => TcaUtility::getInput(true),
            ],
            'closed' => [
                'exclude' => true,
                'label' => TcaUtility::title('closed'),
                'config' => TcaUtility::getCheckboxToggle(),
            ],
            'cached_counter_posts' => [
                'exclude' => true,
                'label' => TcaUtility::title('cached_counter_posts'),
                'config' => TcaUtility::getNumber(),
            ],
            'cached_counter_views' => [
                'exclude' => true,
                'label' => TcaUtility::title('cached_counter_views'),
                'config' => TcaUtility::getNumber(),
            ],
            'sticky' => [
                'exclude' => true,
                'label' => TcaUtility::title('sticky'),
                'config' => TcaUtility::getCheckboxToggle(),
            ],
            'files' => [
                'exclude' => true,
                'label' => TcaUtility::title('files'),
                'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                    'files',
                    [
                        'appearance' => [
                            'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference'
                        ],
                        'foreign_types' => [
                            '0' => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ]
                        ],
                        'foreign_match_fields' => [
                            'fieldname' => 'files',
                            'tablenames' => 'tx_forums_domain_model_thread',
                        ],
                        'maxitems' => 1
                    ]
                ),

            ],
            'posts' => [
                'exclude' => true,
                'label' => TcaUtility::title('posts'),
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => 'tx_forums_domain_model_post',
                    'foreign_field' => 'thread',
                    'foreign_sortby' => 'sorting',
                    'maxitems' => 9999,
                    'appearance' => [
                        'collapseAll' => 0,
                        'levelLinksPosition' => 'top',
                        'showSynchronizationLink' => 1,
                        'showPossibleLocalizationRecords' => 1,
                        'useSortable' => 1,
                        'showAllLocalizationLink' => 1
                    ],
                ],

            ],
            'tags' => [
                'exclude' => true,
                'label' => TcaUtility::title('tags'),
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectMultipleSideBySide',
                    'foreign_table' => 'tx_forums_domain_model_tag',
                    'MM' => 'tx_forums_thread_tag_mm',
                    'size' => 10,
                    'autoSizeMax' => 30,
                    'maxitems' => 9999,
                    'multiple' => 0,
                    'fieldControl' => [
                        'editPopup' => [
                            'disabled' => false,
                        ],
                        'addRecord' => [
                            'disabled' => false,
                        ],
                        'listModule' => [
                            'disabled' => true,
                        ],
                    ],
                ],

            ],
            'active_users' => [
                'exclude' => true,
                'label' => TcaUtility::title('active_users'),
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectMultipleSideBySide',
                    'foreign_table' => 'fe_users',
                    'default' => 0,
                    'size' => 10,
                    'autoSizeMax' => 30,
                    'maxitems' => 1,
                    'multiple' => 0,
                    'fieldControl' => [
                        'editPopup' => [
                            'disabled' => false,
                        ],
                        'addRecord' => [
                            'disabled' => false,
                        ],
                        'listModule' => [
                            'disabled' => true,
                        ],
                    ],
                ],

            ],
        ],
    ),
];
