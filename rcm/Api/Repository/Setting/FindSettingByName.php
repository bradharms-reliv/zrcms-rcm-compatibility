<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Setting;

/**
 * @deprecated BC ONLY
 */
class FindSettingByName extends \Rcm\Api\Repository\Setting\FindSettingByName
{
    public function __construct()
    {
    }

    /**
     * @param string $name
     * @param array  $options
     *
     * @return void
     * @throws \Exception
     */
    public function __invoke(
        string $name,
        array $options = []
    ) {
        throw new \Exception('ZRCMS does not support this feature:' . get_class($this));
    }
}
