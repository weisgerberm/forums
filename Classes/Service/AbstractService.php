<?php
/**
 * Copyright (c) 2022. Mark Weisgerber (mark.weisgerber@outlook.de)
 */

namespace Weisgerber\Forums\Service;

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use Weisgerber\Forums\Service\Configuration\ConfigurationService;

abstract class AbstractService implements SingletonInterface
{

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var \Weisgerber\Forums\Service\Configuration\ConfigurationService
     */
    protected $configurationService;

    public function __construct ()
    {

        $this->configurationService = GeneralUtility::makeInstance(ConfigurationService::class);
    }

    /**
     * Liefert das TS der Extension
     *
     * @return array
     */
    public function getSettings (): array
    {
        return $this->configurationService->getSettings();
    }

    /**
     * Liefert die ExtensionConfig
     *
     * @return array
     */
    public function getExtensionConfig (): array
    {
        return unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['forums']);
    }

    /**
     * @return ConfigurationManagerInterface
     */
    public function getConfigurationManager (): ConfigurationManagerInterface
    {
        return $this->objectManager->get(ConfigurationManagerInterface::class);
    }

}
