<?php

use TYPO3\CMS\Core\DataHandling\PageDoktypeRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') || die();

(static function() {

})();

$dokTypeRegistry = GeneralUtility::makeInstance(PageDoktypeRegistry::class);
$dokTypeRegistry->add(
    \Weisgerber\Forums\Domain\Model\Page::PAGE_TYPE_SUBFORUM,
    [
        'type' => 'sys',
        'allowedTables' => '*',
    ],
);
$dokTypeRegistry->add(
    \Weisgerber\Forums\Domain\Model\Page::PAGE_TYPE_SUBFORUM_CATEGORY,
    [
        'type' => 'sys',
        'allowedTables' => '*',
    ],
);
