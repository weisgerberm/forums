<?php

use Weisgerber\DarfIchMit\Utility\TcaUtility;
use Weisgerber\Forums\Domain\Model\Post;
use Weisgerber\Forums\Domain\Model\Tag;
use Weisgerber\Forums\Domain\Model\Thread;

return [
    'ctrl' => TcaUtility::getController(Thread::TABLE_NAME,'forums', [
        'default_sortby' => 'last_posted_on DESC',
    ], false),
    'palettes' => TcaUtility::getPalettes([
        'p_cache' => [
            'label' => 'Zwischengespeicherte Werte',
            'showitem' => 'cached_counter_posts, cached_counter_views'
        ],
    ]),
    'types' => [
        '1' => ['showitem' => TcaUtility::tab(null, ['p_name','p_slug','p_cache','posts','tags','subscribers','last_posted_on']).
            TcaUtility::languageTab().
            TcaUtility::accessTab().'closed,sticky,'.
            TcaUtility::notesTab()],
    ],
    'columns' => \nn\t3::TCA()->createConfig(
        Thread::TABLE_NAME,
        ['hidden','crdate'],
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
            'last_posted_on' => [
                'exclude' => true,
                'label' => TcaUtility::title('last_posted_on'),
                'config' => TcaUtility::getDate(true, [
                    'range' => [
                        'upper' => mktime(0, 0, 0, 1, 1, 2038)
                    ],
                ]),
            ],
            'posts' => [
                'exclude' => true,
                'label' => TcaUtility::title('posts'),
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => Post::TABLE_NAME,
                    'foreign_field' => 'thread',
                    'maxitems' => 99999,
                    'appearance' => [
                        'collapseAll' => 1,
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
                    'foreign_table' => Tag::TABLE_NAME,
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
            'subscribers' => [
                'exclude' => true,
                'label' => TcaUtility::title('subscribers'),
                'description' => TcaUtility::desc('subscribers'),
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectMultipleSideBySide',
                    'foreign_table' => 'fe_users',
                    'MM' => 'tx_forums_thread_fe_users_mm',
                    'default' => 0,
                    'size' => 10,
                    'autoSizeMax' => 30,
                    'maxitems' => 99999,
                    'multiple' => 0,
                    'fieldControl' => [
                        'editPopup' => [
                            'disabled' => false,
                        ],
                        'addRecord' => [
                            'disabled' => true,
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
