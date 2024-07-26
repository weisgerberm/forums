<?php
defined('TYPO3') || die();

$tmp_forums_columns = [
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

];

$tmp_forums_columns['frontenduser7'] = [
    'config' => [
        'type' => 'passthrough',
    ]
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tmp_forums_columns);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
$GLOBALS['TCA']['fe_users']['types'][0]['showitem'] .= ',--div--;Forum, threads_per_page, posts_per_page, subscribe_to_thread_after_reply, allow_display_email, cached_counter_posts, posts, thread_subscriptions, signatures, post_likes, poll_votes, friends, private_messages, blacklisted_users';
