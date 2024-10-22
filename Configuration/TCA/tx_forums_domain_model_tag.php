<?php

use Weisgerber\DarfIchMit\Utility\TcaUtility;
use Weisgerber\Forums\Domain\Model\Tag;

return [
    'ctrl' => TcaUtility::getController(Tag::TABLE_NAME,'forums',[
        'security' => [
            'ignorePageTypeRestriction' => true,
            'descriptionColumn' => '',
        ],
        'default_sortby' => 'ORDER BY sorting ASC',
        'sortby' => 'sorting',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'title',
    ], true, false),
    'types' => [
        '1' => ['showitem' => TcaUtility::tab(null, ['p_title']).
            TcaUtility::finishTabs()
        ],
    ],
    'columns' => \nn\t3::TCA()->createConfig(
        Tag::TABLE_NAME,
        ['sys_language_uid','l10n_parent','l10n_diffsource','hidden','t3ver_label'],
        [
            'title' => [
                'exclude' => true,
                'label' => TcaUtility::title('title'),
                'config' => TcaUtility::getInput()
            ],

        ]
    ),
];
