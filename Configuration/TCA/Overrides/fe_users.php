<?php
defined('TYPO3') || die();

$tmp_forums_columns = [

    'last_activity' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.last_activity',
        'config' => [
            'dbType' => 'datetime',
            'type' => 'input',
            'renderType' => 'inputDateTime',
            'size' => 12,
            'eval' => 'datetime',
            'default' => null,
        ],
    ],
    'profile_visits' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.profile_visits',
        'config' => [
            'type' => 'input',
            'size' => 4,
            'eval' => 'int',
            'default' => 0
        ]
    ],
    'avatar' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.avatar',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'foreign_table' => 'tx_forums_domain_model_avatar',
            'default' => 0,
            'minitems' => 0,
            'maxitems' => 1,
        ],
    ],
    'social_facebook' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.social_facebook',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'default' => ''
        ],
    ],
    'social_instagram' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.social_instagram',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'default' => ''
        ],
    ],
    'social_pinterest' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.social_pinterest',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'default' => ''
        ],
    ],
    'social_twitter' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.social_twitter',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'default' => ''
        ],
    ],
    'social_youtube' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.social_youtube',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'default' => ''
        ],
    ],
    'prefered_timezone' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.prefered_timezone',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'default' => ''
        ],
    ],
    'allow_email_news' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.allow_email_news',
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
    'allow_show_online_status' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.allow_show_online_status',
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
    'social_steam' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.social_steam',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'default' => ''
        ],
    ],
    'social_xbox' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.social_xbox',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'default' => ''
        ],
    ],
    'social_psn' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.social_psn',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'default' => ''
        ],
    ],
    'social_nintendo' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.social_nintendo',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'default' => ''
        ],
    ],
    'social_xing' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.social_xing',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'default' => ''
        ],
    ],
    'threads_per_page' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.threads_per_page',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['-- Label --', 0],
            ],
            'size' => 1,
            'maxitems' => 1,
            'eval' => ''
        ],
    ],
    'posts_per_page' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.posts_per_page',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['-- Label --', 0],
            ],
            'size' => 1,
            'maxitems' => 1,
            'eval' => ''
        ],
    ],
    'subscribe_to_thread_after_reply' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.subscribe_to_thread_after_reply',
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
    'allow_display_email' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.allow_display_email',
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
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.cached_counter_posts',
        'config' => [
            'type' => 'input',
            'size' => 4,
            'eval' => 'int',
            'default' => 0
        ]
    ],
    'posts' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.posts',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_forums_domain_model_post',
            'foreign_field' => 'frontenduser',
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
    'thread_subscriptions' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.thread_subscriptions',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_forums_domain_model_threadsubscription',
            'foreign_field' => 'frontenduser',
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
    'signatures' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.signatures',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_forums_domain_model_signature',
            'foreign_field' => 'frontenduser',
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
    'post_likes' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.post_likes',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_forums_domain_model_postlike',
            'foreign_field' => 'frontenduser',
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
    'poll_votes' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.poll_votes',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_forums_domain_model_pollvote',
            'foreign_field' => 'frontenduser',
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
    'friends' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.friends',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectMultipleSideBySide',
            'foreign_table' => 'fe_users',
            'MM' => 'tx_forums_frontenduser_frontenduser_mm',
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
    'private_messages' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.private_messages',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_forums_domain_model_privatemessage',
            'foreign_field' => 'frontenduser',
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
    'self_description' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.private_messages',
        'config' => \Weisgerber\DarfIchMit\Utility\TcaUtility::getText()
    ],
    'blacklisted_users' => [
        'exclude' => true,
        'label' => 'LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser.blacklisted_users',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'fe_users',
            'foreign_field' => 'frontenduser7',
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

];

$tmp_forums_columns['frontenduser7'] = [
    'config' => [
        'type' => 'passthrough',
    ]
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tmp_forums_columns);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
$GLOBALS['TCA']['fe_users']['types'][0]['showitem'] .= ',--div--;LLL:EXT:forums/Resources/Private/Language/locallang_db.xlf:tx_forums_domain_model_frontenduser,avatar,last_activity, profile_visits, social_facebook, social_instagram, social_pinterest, social_twitter, social_youtube, prefered_timezone, allow_email_news, allow_show_online_status, social_steam, social_xbox, social_psn, social_nintendo, social_xing, threads_per_page, posts_per_page, subscribe_to_thread_after_reply, allow_display_email, cached_counter_posts, posts, thread_subscriptions, signatures, post_likes, poll_votes, friends, private_messages, blacklisted_users';

$GLOBALS['TCA']['fe_users']['columns']['last_activity']['config']['readOnly'] = 1;
$GLOBALS['TCA']['fe_users']['columns']['profile_visits']['config']['readOnly'] = 1;
$GLOBALS['TCA']['fe_users']['columns']['cached_counter_posts']['config']['readOnly'] = 1;

// get crdate in frontend
//$GLOBALS['TCA']['fe_users']['columns']['image']['config']['type'] = 'passthrough';
