<?php

declare (strict_types=1);
namespace RectorPrefix202209;

use Rector\Config\RectorConfig;
use Rector\Symfony\Rector\MethodCall\AddViolationToBuildViolationRector;
return static function (RectorConfig $rectorConfig) : void {
    $rectorConfig->rule(AddViolationToBuildViolationRector::class);
};
