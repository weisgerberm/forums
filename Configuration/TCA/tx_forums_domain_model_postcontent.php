<?php

use Weisgerber\DarfIchMit\Utility\TcaUtility;
use Weisgerber\Forums\Domain\Model\PostContent;

return [
    'ctrl' => TcaUtility::getController(PostContent::TABLE_NAME, 'forums', [
        'default_sortby' => '',
        'descriptionColumn' => '',
        'label' => 'description',
        'hideTable' => 1,
        'searchFields' => '',
    ], false, false),
    'palettes' => TcaUtility::getPalettes(),
    'types' => [
        '1' => ['showitem' => TcaUtility::tab(null, ['p_txt']) .
            TcaUtility::finishTabs()],
    ],
    'columns' => \nn\t3::TCA()->createConfig(
        PostContent::TABLE_NAME,
        ['hidden', 'crdate'],
        [
            'description' => [
                'exclude' => true,
                'label' => TcaUtility::title('description'),
                'config' => TcaUtility::getText(),

            ],
            'post' => [
                'config' => [
                    'type' => 'passthrough',
                ],
            ],
        ]
    )
];
