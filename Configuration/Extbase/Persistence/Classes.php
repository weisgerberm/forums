<?php

declare(strict_types=1);

return [
    \Weisgerber\Forums\Domain\Model\Page::class => [
        'tableName' => 'pages',

    ],
    \Weisgerber\Forums\Domain\Model\Thread::class => [
        'tableName' => \Weisgerber\Forums\Domain\Model\Thread::TABLE_NAME,
        'properties' => [
            'crdate' => [
                'fieldName' => 'crdate',
            ],
        ],
    ],
];
