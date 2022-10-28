<?php
defined('TYPO3') || die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Forums',
    'Show',
    'Show threads from this page'
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
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder