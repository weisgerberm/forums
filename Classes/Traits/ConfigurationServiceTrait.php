<?php

namespace Weisgerber\Forums\Traits;

trait ConfigurationServiceTrait
{
    /**
     * configurationService
     *
     * @var \Weisgerber\Forums\Services\Configuration\ConfigurationService
     */
    protected \Weisgerber\Forums\Services\Configuration\ConfigurationService $configurationService;

    /**
     * @param \Weisgerber\Forums\Services\Configuration\ConfigurationService $configurationService
     */
    public function injectConfigurationService(\Weisgerber\Forums\Services\Configuration\ConfigurationService $configurationService): void
    {
        $this->configurationService = $configurationService;
    }
}
