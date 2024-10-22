<?php

use Weisgerber\DarfIchMit\Utility\TcaUtility;
use Weisgerber\Forums\Domain\Model\{Poll, PollOption, PollVote};

return [
    'ctrl' => TcaUtility::getController(Poll::TABLE_NAME, 'forums', [
        'default_sortby' => '',
    ], false, false),
    'palettes' => TcaUtility::getPalettes(),
    'types' => [
        '1' => ['showitem' => TcaUtility::tab(null, ['p_title','poll_votes','poll_options']) .
            TcaUtility::finishTabs()],
    ],
    'columns' => \nn\t3::TCA()->createConfig(
        Poll::TABLE_NAME,
        ['hidden', 'crdate'],
        [
            'title' => [
                'exclude' => true,
                'label' => TcaUtility::title('title'),
                'config' => TcaUtility::getInput(),
            ],
            'poll_votes' => [
                'exclude' => true,
                'label' => TcaUtility::title('poll_votes'),
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => PollVote::TABLE_NAME,
                    'foreign_field' => 'poll',
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
            'poll_options' => [
                'exclude' => true,
                'label' => TcaUtility::title('poll_options'),
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => PollOption::TABLE_NAME,
                    'foreign_field' => 'poll',
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
