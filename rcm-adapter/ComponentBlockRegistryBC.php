<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Zrcms\ContentCore\Block\Api\Component\ReadComponentConfigBlockBc;
use Zrcms\ContentCore\Block\Api\Render\RenderBlockBc;
use Zrcms\ContentCore\Block\Fields\FieldsBlockComponentConfig;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ComponentBlockRegistryBC
{
    const DEFAULT_COMPONENT_REGISTRY_KEY = 'zrcms-components';

    /**
     * @param array  $appConfig
     * @param string $configFile I.E. __DIR__ . '/autoload/zrcms-blocks-bc.php'
     * @param string $componentRegistryKey
     *
     * @return void
     */
    public static function buildConfigFile(
        $appConfig,
        string $configFile,
        string $componentRegistryKey = self::DEFAULT_COMPONENT_REGISTRY_KEY
    ) {
        $bcConfigs = ComponentBlockRegistryBC::getBcConfigs(
            $appConfig
        );

        $configFileContents = "<pre>"
            . "<?php\n\n"
            . "return [\n"
            . "    '{$componentRegistryKey}' => \n"
            . "    " . var_export($bcConfigs, true) . "\n"
            . "];\n";

        file_put_contents(
            $configFile,
            $configFileContents
        );
    }

    /**
     * @param array  $appConfig
     * @param string $componentRegistryKey
     *
     * @return array
     */
    public static function buildAppConfig(
        $appConfig,
        string $componentRegistryKey = self::DEFAULT_COMPONENT_REGISTRY_KEY
    ): array
    {
        if (!array_key_exists('rcmPlugin', $appConfig)) {
            return $appConfig;
        }

        foreach ($appConfig['rcmPlugin'] as $rcmPluginName => $rcmPluginConfig) {
            $appConfig[$componentRegistryKey]['block.' . $rcmPluginName] = ComponentBlockRegistryBC::getBcPluginConfig(
                $rcmPluginName,
                $rcmPluginConfig
            );
        }

        return $appConfig;
    }

    /**
     * @param array $appConfig
     *
     * @return array
     */
    public static function getBcConfigs(
        $appConfig
    ): array
    {
        if (!array_key_exists('rcmPlugin', $appConfig)) {
            return [];
        }

        $componentRegistry = [];

        foreach ($appConfig['rcmPlugin'] as $rcmPluginName => $rcmPluginConfig) {
            $componentRegistry['block.' . $rcmPluginName] = ComponentBlockRegistryBC::getBcPluginConfig(
                $rcmPluginName,
                $rcmPluginConfig
            );
        }

        return $componentRegistry;
    }

    /**
     * @param string $rcmPluginName
     * @param array  $rcmPluginConfig
     * @param array  $componentRegistryEntry
     *
     * @return array
     */
    public static function getBcPluginConfig(
        string $rcmPluginName,
        array $rcmPluginConfig,
        array $componentRegistryEntry = []
    ): array {
        if (empty($rcmPluginConfig[FieldsBlockComponentConfig::TYPE])) {
            $rcmPluginConfig[FieldsBlockComponentConfig::TYPE] = 'block';
        }
        // FIX for collisions
        if ($rcmPluginConfig[FieldsBlockComponentConfig::TYPE] !== 'block') {
            $componentRegistryEntry[FieldsBlockComponentConfig::CATEGORY] = $rcmPluginConfig[FieldsBlockComponentConfig::TYPE];
            $componentRegistryEntry[FieldsBlockComponentConfig::TYPE] = 'block';
        }

        $componentRegistryEntry[FieldsBlockComponentConfig::COMPONENT_CONFIG_READER]
            = ReadComponentConfigBlockBc::SERVICE_ALIAS;
        $componentRegistryEntry[FieldsBlockComponentConfig::CONFIG_LOCATION]
            = $rcmPluginName;
        $componentRegistryEntry[FieldsBlockComponentConfig::MODULE_DIRECTORY]
            = __DIR__;
        $componentRegistryEntry[FieldsBlockComponentConfig::NAME]
            = $rcmPluginName;
        $componentRegistryEntry[FieldsBlockComponentConfig::RENDERER]
            = RenderBlockBc::SERVICE_ALIAS;

        return $componentRegistryEntry;
    }
}
