<?php
defined('TYPO3') || die();
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
$GLOBALS['TCA']['tx_forums_domain_model_postcontent']['ctrl']['iconfile'] = 'EXT:forums/Resources/Public/Icons/tx_forums_domain_model_postcontent.png';

$GLOBALS['TCA']['tx_forums_domain_model_postcontent']['ctrl']['label_alt'] = 'content';
$GLOBALS['TCA']['tx_forums_domain_model_postcontent']['types']['1']['showitem'] = 'headline, content, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden';

// get crdate in frontend
$GLOBALS['TCA']['tx_forums_domain_model_postcontent']['columns']['crdate']['config']['type'] = 'passthrough';
