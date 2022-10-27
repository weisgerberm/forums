<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Forums',
    'description' => 'Modern forum system based on extbase & fluid',
    'category' => 'plugin',
    'author' => 'Mark Weisgerber',
    'author_email' => 'mark.weisgerber@outlook.de',
    'state' => 'alpha',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.0.0-11.5.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
