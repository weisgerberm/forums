<?php

use Weisgerber\Forums\Controller\BackendController;

return [
    'dim_module' => [
        'labels' => 'LLL:EXT:darf_ich_mit/Resources/Private/Language/locallang_mod.xlf',
        'iconIdentifier' => 'extension-dim-module',
        'position' => ['after' => 'web'],
    ],
    'web_Forums' => [
        'parent' => 'dim_module',
        'position' => ['before' => '*'],
        'access' => 'user',
        'workspaces' => 'live',
        'iconIdentifier' => 'forums-plugin-show',
        'path' => '/module/web/Forums',
        'labels' => 'LLL:EXT:forums/Resources/Private/Language/locallang_forums.xlf',
        'extensionName' => 'Forums',
        'controllerActions' => [
            BackendController::class => [
                'status',
                'news',
                'createNewsThread'
            ],
        ],
    ],
];
