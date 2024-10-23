<?php

use Weisgerber\DarfIchMit\Utility\TcaUtility;
use Weisgerber\Forums\Domain\Model\Post;
use Weisgerber\Forums\Domain\Model\PostReport;

return [
    'ctrl' => TcaUtility::getController(PostReport::TABLE_NAME, 'forums', [
        'default_sortby' => '',
        'label' => 'description',
        'searchFields' => '',
    ], false, false),
    'types' => [
        '1' => ['showitem' => TcaUtility::tab(null, ['p_txt','post_reference','frontend_user'])
            ]
    ],
    'columns' => \nn\t3::TCA()->createConfig(
        PostReport::TABLE_NAME,
        ['hidden'],
        [
            'description' => [
                'exclude' => true,
                'label' => TcaUtility::title('description'),
                'config' => TcaUtility::getText(),
            ],
            'post_reference' => [
                'exclude' => true,
                'label' => TcaUtility::title('post_reference'),
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'foreign_table' => Post::TABLE_NAME,
                    'default' => 0,
                    'minitems' => 0,
                    'maxitems' => 1,
                ],
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
        ]
    ),
];
