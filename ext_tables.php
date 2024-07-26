<?php

use TYPO3\CMS\Core\DataHandling\PageDoktypeRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_forums_domain_model_thread', 'EXT:forums/Resources/Private/Language/locallang_csh_tx_forums_domain_model_thread.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_forums_domain_model_thread');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_forums_domain_model_post', 'EXT:forums/Resources/Private/Language/locallang_csh_tx_forums_domain_model_post.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_forums_domain_model_post');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_forums_domain_model_threadsubscription', 'EXT:forums/Resources/Private/Language/locallang_csh_tx_forums_domain_model_threadsubscription.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_forums_domain_model_threadsubscription');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_forums_domain_model_signature', 'EXT:forums/Resources/Private/Language/locallang_csh_tx_forums_domain_model_signature.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_forums_domain_model_signature');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_forums_domain_model_postcontent', 'EXT:forums/Resources/Private/Language/locallang_csh_tx_forums_domain_model_postcontent.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_forums_domain_model_postcontent');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_forums_domain_model_postreport', 'EXT:forums/Resources/Private/Language/locallang_csh_tx_forums_domain_model_postreport.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_forums_domain_model_postreport');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_forums_domain_model_postlike', 'EXT:forums/Resources/Private/Language/locallang_csh_tx_forums_domain_model_postlike.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_forums_domain_model_postlike');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_forums_domain_model_tag', 'EXT:forums/Resources/Private/Language/locallang_csh_tx_forums_domain_model_tag.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_forums_domain_model_tag');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_forums_domain_model_poll', 'EXT:forums/Resources/Private/Language/locallang_csh_tx_forums_domain_model_poll.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_forums_domain_model_poll');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_forums_domain_model_pollvote', 'EXT:forums/Resources/Private/Language/locallang_csh_tx_forums_domain_model_pollvote.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_forums_domain_model_pollvote');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_forums_domain_model_polloption', 'EXT:forums/Resources/Private/Language/locallang_csh_tx_forums_domain_model_polloption.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_forums_domain_model_polloption');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_forums_domain_model_privatemessage', 'EXT:forums/Resources/Private/Language/locallang_csh_tx_forums_domain_model_privatemessage.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_forums_domain_model_privatemessage');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_forums_domain_model_threadstate', 'EXT:forums/Resources/Private/Language/locallang_csh_tx_forums_domain_model_threadstate.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_forums_domain_model_threadstate');


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
