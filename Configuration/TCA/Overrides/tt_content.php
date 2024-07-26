<?php
defined('TYPO3') || die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Forums',
    'Show',
    'Show threads from this page'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Forums',
    'Subforum',
    'Show subforum from this page'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Forums',
    'Subforums',
    'Show subforums from this page'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Forums',
    'Profile',
    'Profile'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Forums',
    'Latestposts',
    'Latest posts'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Forums',
    'Latestthreads',
    'Latest threads'
);
