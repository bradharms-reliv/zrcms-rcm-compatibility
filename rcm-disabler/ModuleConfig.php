<?php

namespace ZrcmsRcmCompatibility\RcmDisabler;

use Doctrine\Common\Persistence\Mapping\Driver\PHPDriver;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ModuleConfig
{
    /**
     * __invoke
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'doctrine' => [
                'driver' => [
                    'relivContentManager' => [
                        'class' => PHPDriver::class,
                    ]
                ]
            ]
        ];
    }
}
