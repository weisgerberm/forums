<?php

use Weisgerber\DarfIchMit\Utility\TcaUtility;
use Weisgerber\Forums\Domain\Model\PrivateMessage;

return [
    'ctrl' => TcaUtility::getController(PrivateMessage::TABLE_NAME, 'forums', [
        'label' => 'subject',
        'searchFields' => '',
        'default_sortby' => '',
    ], false, false),
    'types' => [
        '1' => ['showitem' => TcaUtility::tab(
            null,
            ['subject', 'content', 'sender', 'receiver'])
            ]
    ],
    'columns' => \nn\t3::TCA()->createConfig(
        PrivateMessage::TABLE_NAME,
        ['hidden', 'crdate'],
        [
            'frontenduser' => TcaUtility::getPassthrough(),
            'subject' => [
                'exclude' => true,
                'label' => TcaUtility::title('subject'),
                'config' => TcaUtility::getInput(true),
            ],
            'content' => [
                'exclude' => true,
                'label' => TcaUtility::title('content'),
                'config' => TcaUtility::getRTE(),
            ],
            'sender' => [
                'exclude' => true,
                'label' => TcaUtility::title('sender'),
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'foreign_table' => 'fe_users',
                    'default' => 0,
                    'minitems' => 0,
                    'maxitems' => 1,
                ],
            ],
            'receiver' => [
                'exclude' => true,
                'label' => TcaUtility::title('receiver'),
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'foreign_table' => 'fe_users',
                    'default' => 0,
                    'minitems' => 0,
                    'maxitems' => 1,
                ],
            ],
        ]
    ),
];
