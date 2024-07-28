<?php

use Weisgerber\DarfIchMit\Utility\TcaUtility;
use Weisgerber\Forums\Domain\Model\Post;

return [
    'ctrl' => TcaUtility::getController(Post::TABLE_NAME, 'forums', [
        'default_sortby' => '',
        'label' => 'spam',
        'searchFields' => '',
    ], false, false),
    'types' => [
        '1' => [
            'showitem' => TcaUtility::tab(
                null,
                ['spam', 'soft_deleted', 'awaiting_admin_approval', 'admin_comment', 'post_content', 'likes', 'poll']
            )
        ],
    ],
    'columns' => \nn\t3::TCA()->createConfig(
        Post::TABLE_NAME,
        ['hidden', 'crdate'],
        [
            'spam' => [
                'exclude' => true,
                'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_post.spam',
                'config' => TcaUtility::getCheckboxToggle(),
            ],
            'soft_deleted' => [
                'exclude' => true,
                'label' => TcaUtility::title('soft_deleted'),
                'config' => TcaUtility::getCheckboxToggle(),
            ],
            'awaiting_admin_approval' => [
                'exclude' => true,
                'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_post.awaiting_admin_approval',
                'config' => TcaUtility::getCheckboxToggle(),
            ],
            'admin_comment' => [
                'exclude' => true,
                'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_post.admin_comment',
                'config' => [
                    'type' => 'text',
                    'enableRichtext' => true,
                    'richtextConfiguration' => 'default',
                    'fieldControl' => [
                        'fullScreenRichtext' => [
                            'disabled' => false,
                        ],
                    ],
                    'cols' => 40,
                    'rows' => 15,
                    'eval' => 'trim',
                ],
            ],
            'post_content' => [
                'exclude' => true,
                'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_post.post_content',
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => 'tx_forums_domain_model_postcontent',
                    'foreign_field' => 'post',
                    'maxitems' => 9999,
                    'appearance' => [
                        'collapseAll' => 0,
                        'levelLinksPosition' => 'top',
                        'showSynchronizationLink' => 1,
                        'showPossibleLocalizationRecords' => 1,
                        'showAllLocalizationLink' => 1
                    ],
                ],

            ],
            'likes' => [
                'exclude' => true,
                'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_post.likes',
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => 'tx_forums_domain_model_postlike',
                    'foreign_field' => 'post',
                    'maxitems' => 9999,
                    'appearance' => [
                        'collapseAll' => 0,
                        'levelLinksPosition' => 'top',
                        'showSynchronizationLink' => 1,
                        'showPossibleLocalizationRecords' => 1,
                        'showAllLocalizationLink' => 1
                    ],
                ],

            ],
            'poll' => [
                'exclude' => true,
                'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_post.poll',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'foreign_table' => 'tx_forums_domain_model_poll',
                    'default' => 0,
                    'minitems' => 0,
                    'maxitems' => 1,
                ],

            ],
            'thread' => [
                'config' => [
                    'type' => 'passthrough',
                ],
            ],
            'frontenduser' => [
                'label' => TcaUtility::title('frontenduser'),
                'description' => TcaUtility::desc('frontenduser'),
                'l10n_mode' => 'exclude',
                'exclude' => true,
                'config' => [
                    'type' => 'group',
                    'allowed' => 'fe_users',
                    'maxitems' => 1,
                    'size' => 1,
                    'default' => 0,
                ],
            ],
        ]
    ),

];
