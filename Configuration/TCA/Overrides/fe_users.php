<?php

use Weisgerber\DarfIchMit\Utility\TcaUtility;
use Weisgerber\Forums\Domain\Model\Post;

defined('TYPO3') || die();

$tmp_forums_columns = [
    'threads_per_page' => [
        'exclude' => true,
        'label' => TcaUtility::title('threads_per_page'),
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['10', 10],
                ['15', 15],
                ['20', 20],
                ['25', 25],
                ['30', 30],
            ],
            'size' => 1,
            'default' => 10,
            'maxitems' => 1,
            'eval' => ''
        ],
    ],
    'posts_per_page' => [
        'exclude' => true,
        'label' => TcaUtility::title('posts_per_page'),
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['15', 15],
                ['20', 20],
                ['25', 25],
                ['30', 30],
                ['35', 35],
            ],
            'size' => 1,
            'default' => 20,
            'maxitems' => 1,
            'eval' => ''
        ],
    ],
    'subscribe_to_thread_after_reply' => [
        'exclude' => true,
        'label' => TcaUtility::title('subscribe_to_thread_after_reply'),
        'config' => TcaUtility::getCheckboxToggle(1),
    ],
    'thread_subscriptions' => [
        'exclude' => true,
        'label' => TcaUtility::title('thread_subscriptions'),
        'description' => TcaUtility::desc('thread_subscriptions'),
        'config' => [
            'type' => 'inline',
            'foreign_table' => \Weisgerber\Forums\Domain\Model\Thread::TABLE_NAME,
            'MM' => 'tx_forums_thread_fe_users_mm',
            'MM_opposite_field' => 'subscribers',
            'maxitems' => 9999,
            'appearance' => [
                'collapseAll' => 1,
                'levelLinksPosition' => 'top',
            ],
        ],
    ],
    // Erstmal nicht nötig weil sonst zu viele Daten andauernd abgefragt werden, auch wenn es lazy ist. Wenn die Posts nötig sind, frag ich sie seperat ab, weil im post eine Referenz zum fe_user vorliegt!
//    'posts' => [
//        'exclude' => true,
//        'label' => TcaUtility::title('posts'),
//        'config' => [
//            'type' => 'inline',
//            'foreign_table' => Post::TABLE_NAME,
//            'foreign_field' => 'frontenduser',
//            'maxitems' => 999999,
//            'appearance' => [
//                'collapseAll' => 1,
//                'levelLinksPosition' => 'top',
//            ],
//        ],
//    ],
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

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tmp_forums_columns);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
$GLOBALS['TCA']['fe_users']['types'][0]['showitem'] .= ',--div--;Forum, threads_per_page, posts_per_page, subscribe_to_thread_after_reply, allow_display_email, thread_subscriptions, post_likes, poll_votes';
