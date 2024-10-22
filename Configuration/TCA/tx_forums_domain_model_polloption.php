<?php

use Weisgerber\DarfIchMit\Utility\TcaUtility;
use Weisgerber\Forums\Domain\Model\PollOption;

return [
    'ctrl' => TcaUtility::getController(PollOption::TABLE_NAME, 'forums', [
        'default_sortby' => '',
        'sortby' => 'sorting',
    ], false, false),
    'palettes' => TcaUtility::getPalettes(),
    'types' => [
        '1' => ['showitem' => TcaUtility::tab(null, ['p_title','poll_votes','poll_options']) .
            TcaUtility::finishTabs()],
    ],
    'columns' => \nn\t3::TCA()->createConfig(
        PollOption::TABLE_NAME,
        ['hidden', 'crdate'],
        [
            'poll' => TcaUtility::getPassthrough(),
            'pollvote' => TcaUtility::getPassthrough(),
            'title' => [
                'exclude' => true,
                'label' => TcaUtility::title('title'),
                'config' => TcaUtility::getInput(),
            ],
        ]
    ),
];
