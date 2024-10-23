<?php

use Weisgerber\DarfIchMit\Utility\TcaUtility;
use Weisgerber\Forums\Domain\Model\PostLike;

return [
    'ctrl' => TcaUtility::getController(PostLike::TABLE_NAME, 'forums', [
        'default_sortby' => '',
        'label' => 'frontenduser',
        'searchFields' => '',
    ], false, false),
    'types' => [
        '1' => ['showitem' => TcaUtility::tab(null, ['frontenduser'])
        ],
    ],
    'columns' => \nn\t3::TCA()->createConfig(
        PostLike::TABLE_NAME,
        ['hidden'],
        [
            'post' => TcaUtility::getPassthrough(),
            'frontenduser' => TcaUtility::getPassthrough(),
        ]
    ),
];
