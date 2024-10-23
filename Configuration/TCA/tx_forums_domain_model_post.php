<?php

use Weisgerber\DarfIchMit\Utility\TcaUtility;
use Weisgerber\Forums\Domain\Model\Post;
use Weisgerber\Forums\Domain\Model\PostContent;

return [
    'ctrl' => TcaUtility::getController(Post::TABLE_NAME, 'forums', [
        'default_sortby' => '',
        'label' => 'post_content',
        'searchFields' => '',
    ], false, false),
    'types' => [
        '1' => [
            'showitem' => TcaUtility::tab(null,['post_content', 'likes']) .
            TcaUtility::accessTab().'spam,allow_html,quote,soft_deleted,awaiting_admin_approval,admin_comment'
        ],
    ],
    'columns' => \nn\t3::TCA()->createConfig(
        Post::TABLE_NAME,
        ['hidden', 'crdate'],
        [
            'spam' => [
                'exclude' => true,
                'label' => TcaUtility::title('spam'),
                'description' => TcaUtility::desc('spam'),
                'config' => TcaUtility::getCheckboxToggle(),
            ],
            'soft_deleted' => [
                'exclude' => true,
                'label' => TcaUtility::title('soft_deleted'),
                'description' => TcaUtility::desc('soft_deleted'),
                'config' => TcaUtility::getCheckboxToggle(),
            ],
            'allow_html' => [
                'exclude' => true,
                'label' => TcaUtility::title('allow_html'),
                'description' => TcaUtility::desc('allow_html'),
                'config' => TcaUtility::getCheckboxToggle(),
            ],
            'awaiting_admin_approval' => [
                'exclude' => true,
                'label' => TcaUtility::title('awaiting_admin_approval'),
                'config' => TcaUtility::getCheckboxToggle(),
            ],
            'admin_comment' => [
                'exclude' => true,
                'label' => TcaUtility::title('admin_comment'),
                'config' => TcaUtility::getText(),
            ],
            'post_content' => [
                'exclude' => true,
                'label' => TcaUtility::title('post_content'),
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => PostContent::TABLE_NAME,
                    'foreign_field' => 'post',
                    'maxitems' => 9999,
                    'appearance' => [
                        'collapseAll' => 1,
                        'showNewRecordLink' => 0,
                    ],
                ],

            ],
            'likes' => [
                'exclude' => true,
                'label' => TcaUtility::title('likes'),
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
                'label' => TcaUtility::title('poll'),
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
            'quote' => [
                'label' => TcaUtility::title('quote'),
                'description' => TcaUtility::desc('quote'),
                'l10n_mode' => 'exclude',
                'exclude' => true,
                'config' => [
                    'type' => 'group',
                    'allowed' => PostContent::TABLE_NAME,
                    'maxitems' => 1,
                    'size' => 1,
                    'default' => 0,
                ],
            ],
        ]
    ),

];
