<?php
defined('TYPO3') || die();
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
$GLOBALS['TCA']['tx_forums_domain_model_post']['ctrl']['iconfile'] = 'EXT:forums/Resources/Public/Icons/tx_forums_domain_model_post.png';

$GLOBALS['TCA']['tx_forums_domain_model_post']['types']['1']['showitem'] = 'post_content, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, spam, awaiting_admin_approval, --div--;LLL:EXT:forums/Resources/Private/Language/locallang_tabs.xlf:readonly, likes, poll, frontenduser';
