<?php

use Weisgerber\DarfIchMit\Utility\TcaUtility;

defined('TYPO3') or die();

$tmp_news_columns = [
    'forums_thread' => [
        'exclude' => true,
        'label' => TcaUtility::title('thread'),
        'config' => [
            'type' => 'inline',
            'foreign_table' => \Weisgerber\Forums\Domain\Model\Thread::TABLE_NAME,
            'maxitems' => 1,
            'appearance' => [
                'collapseAll' => 1,
                'levelLinksPosition' => 'none',
            ],
        ],
    ],
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', $tmp_news_columns);
$GLOBALS['TCA']['tx_news_domain_model_news']['types'][0]['showitem'] .= ',--div--;Forum, forums_thread';
