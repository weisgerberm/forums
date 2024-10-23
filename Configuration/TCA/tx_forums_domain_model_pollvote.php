<?php

use Weisgerber\DarfIchMit\Utility\TcaUtility;
use Weisgerber\Forums\Domain\Model\PollOption;
use Weisgerber\Forums\Domain\Model\PollVote;

return [
    'ctrl' => TcaUtility::getController(PollVote::TABLE_NAME, 'forums', [
        'default_sortby' => '',
        'label' => 'selected_choice',
        'searchFields' => '',
    ], false, false),
    'types' => [
        '1' => ['showitem' => TcaUtility::tab(null,['selected_choice'])
            ]
    ],
    'columns' => \nn\t3::TCA()->createConfig(
        PollVote::TABLE_NAME,
        ['hidden', 'crdate'],
        [
            'frontenduser' => TcaUtility::getPassthrough(),
            'poll' => TcaUtility::getPassthrough(),
            'selected_choice' => [
                'exclude' => true,
                'label' => TcaUtility::title('selected_choice'),
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => PollOption::TABLE_NAME,
                    'foreign_field' => 'pollvote',
                    'foreign_sortby' => 'sorting',
                    'maxitems' => 9999,
                    'appearance' => [
                        'collapseAll' => 0,
                        'levelLinksPosition' => 'top',
                        'showSynchronizationLink' => 1,
                        'showPossibleLocalizationRecords' => 1,
                        'useSortable' => 1,
                        'showAllLocalizationLink' => 1
                    ],
                ],
            ],
        ]
    ),
];
