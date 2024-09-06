<?php
/**
 * Copyright (c) 2022. Mark Weisgerber (mark.weisgerber@outlook.de)
 */

namespace Weisgerber\Forums\Service;

use TYPO3\CMS\Core\SingletonInterface;
use Weisgerber\DarfIchMit\Traits\ConfigurationServiceTrait;

abstract class AbstractService implements SingletonInterface
{
    use ConfigurationServiceTrait;
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
}
