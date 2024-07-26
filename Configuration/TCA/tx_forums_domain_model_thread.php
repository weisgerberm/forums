<?php

use Weisgerber\DarfIchMit\Utility\TcaUtility;
use Weisgerber\Forums\Domain\Model\Thread;

return [
    'ctrl' => TcaUtility::getController(Thread::TABLE_NAME,'forums', [
        'sortby' => 'sorting',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden'
        ],
        'searchFields' => 'headline,slug'
    ]),
    'types' => [
        '1' => ['showitem' => TcaUtility::tab(null, ['headline','closed','cached_counter_posts','cached_counter_views','sticky','slug','files','posts','tags','active_users']).
            TcaUtility::finishTabs()],
    ],
    'columns' => \nn\t3::TCA()->createConfig(
        Thread::TABLE_NAME,
        ['hidden'],
        [
            'categories' => TcaUtility::getCategory('1'),
            'headline' => [
                'exclude' => true,
                'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_thread.headline',
                'config' => [
                    'type' => 'input',
                    'size' => 30,
                    'eval' => 'trim',
                    'default' => ''
                ],
            ],
            'closed' => [
                'exclude' => true,
                'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_thread.closed',
                'config' => [
                    'type' => 'check',
                    'renderType' => 'checkboxToggle',
                    'items' => [
                        [
                            0 => '',
                            1 => '',
                        ]
                    ],
                    'default' => 0,
                ]
            ],
            'cached_counter_posts' => [
                'exclude' => true,
                'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_thread.cached_counter_posts',
                'config' => [
                    'type' => 'input',
                    'size' => 4,
                    'eval' => 'int',
                    'default' => 0
                ]
            ],
            'cached_counter_views' => [
                'exclude' => true,
                'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_thread.cached_counter_views',
                'config' => [
                    'type' => 'input',
                    'size' => 4,
                    'eval' => 'int',
                    'default' => 0
                ]
            ],
            'sticky' => [
                'exclude' => true,
                'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_thread.sticky',
                'config' => [
                    'type' => 'check',
                    'renderType' => 'checkboxToggle',
                    'items' => [
                        [
                            0 => '',
                            1 => '',
                        ]
                    ],
                    'default' => 0,
                ]
            ],
            'slug' => [
                'exclude' => true,
                'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_thread.slug',
                'config' => [
                    'type' => 'slug',
                    'size' => 50,
                    'generatorOptions' => [
                        'fields' => ['title'], // TODO: adjust this field to the one you want to use
                        'fieldSeparator' => '-',
                        'replacements' => [
                            '/' => '',
                        ],
                    ],
                    'fallbackCharacter' => '-',
                    'eval' => 'uniqueInPid',
                ],

            ],
            'files' => [
                'exclude' => true,
                'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_thread.files',
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
                'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_thread.posts',
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
                'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_thread.tags',
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
                'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_thread.active_users',
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
