<?php

namespace Weisgerber\Forums\Service\Configuration;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

class ConfigurationService implements SingletonInterface {
    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     */
    protected $configurationManager;

    /**
     * @var \TYPO3\CMS\Core\Configuration\ExtensionConfiguration
     */
    protected $extensionConfiguration;

    public function __construct(ConfigurationManagerInterface $configurationManager, ExtensionConfiguration $extensionConfiguration) {
        $this->configurationManager = $configurationManager;
        $this->extensionConfiguration = $extensionConfiguration;
    }

    /**
     * @param string|null $pluginName
     * @return array
     */
    public function getSettings($pluginName = null) {
        return $this->configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
            'Forums',
            $pluginName
        );
    }

    /**
     * @param string|null $pluginName
     * @return array
     */
    public function getFrameworkConfiguration($pluginName = null) {
        return $this->configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK,
            'Forums',
            $pluginName
        );
    }

    /**
     * @return ConfigurationManagerInterface
     */
    public function getConfigurationManager() {
        return $this->configurationManager;
    }

    /**
     * @return array
     */
    public function getExtensionConfiguration() {
        return $this->extensionConfiguration->get('forums');
    }
}
