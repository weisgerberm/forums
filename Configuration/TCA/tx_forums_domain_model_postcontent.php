<?php

use Weisgerber\DarfIchMit\Utility\TcaUtility;
use Weisgerber\Forums\Domain\Model\PostContent;

return [
    'ctrl' => TcaUtility::getController(PostContent::TABLE_NAME, 'forums', [
        'default_sortby' => '',
        'descriptionColumn' => '',
        'label' => 'description',
        'searchFields' => '',
    ], false, false),
    'types' => [
        '1' => ['showitem' => TcaUtility::tab(null, ['description'])],
    ],
    'columns' => \nn\t3::TCA()->createConfig(
        PostContent::TABLE_NAME,
        ['hidden', 'crdate'],
        [
            'description' => [
                'exclude' => true,
                'label' => TcaUtility::title('description'),
                'config' => [
                    'type' => 'text',
                    'enableRichtext' => true,
                    'richtextConfiguration' => 'default',
                    'fieldControl' => [
                        'fullScreenRichtext' => [
                            'disabled' => false,
                        ],
                    ],
                    'cols' => 40,
                    'rows' => 15,
                    'eval' => 'trim',
                ],

            ],
            'post' => [
                'config' => [
                    'type' => 'passthrough',
                ],
            ],
        ]
    )
];
