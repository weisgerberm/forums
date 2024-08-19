<?php

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [
    'forums-plugin-show' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:forums/Resources/Public/Icons/user_plugin_show.svg'
    ],
    'forums-plugin-subforum' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:forums/Resources/Public/Icons/user_plugin_subforum.svg'
    ],
    'forums-plugin-subforums' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:forums/Resources/Public/Icons/user_plugin_subforums.svg'
    ],
    'forums-plugin-profile' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:forums/Resources/Public/Icons/user_plugin_profile.svg'
    ],
    'forums-plugin-latestposts' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:forums/Resources/Public/Icons/user_plugin_latestposts.svg'
    ],
    'forums-plugin-latestthreads' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:forums/Resources/Public/Icons/user_plugin_latestthreads.svg'
    ],
];
