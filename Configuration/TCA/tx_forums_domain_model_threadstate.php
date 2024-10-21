<?php

use Weisgerber\DarfIchMit\Utility\TcaUtility;
use Weisgerber\Forums\Domain\Model\ThreadState;

return [
    'ctrl' => TcaUtility::getController(ThreadState::TABLE_NAME,'forums', [
        'label' => 'last_visit',
        'searchFields' => '',
    ], false, false),
    'types' => [
        '1' => ['showitem' => TcaUtility::tab(null, ['last_visit','frontend_user','thread'])
        ],
    ],
    'columns' => \nn\t3::TCA()->createConfig(
        ThreadState::TABLE_NAME,
        ['hidden', 'crdate'],
        [
           'last_visit' => [
                'exclude' => true,
                'label' => TcaUtility::title('last_visit'),
                'config' => TcaUtility::getDate(true),
            ],
            'frontend_user' => [
                'exclude' => true,
                'label' => TcaUtility::title('frontend_user'),
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'foreign_table' => 'fe_users',
                    'default' => 0,
                    'minitems' => 0,
                    'maxitems' => 1,
                ],
            ],
            'thread' => [
                'exclude' => true,
                'label' => TcaUtility::title('thread'),
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'foreign_table' => \Weisgerber\Forums\Domain\Model\Thread::TABLE_NAME,
                    'default' => 0,
                    'minitems' => 0,
                    'maxitems' => 1,
                ],
            ],
        ]
    ),
];
