<?php

namespace Modules\HealthMonitor\Services;

use Modules\HealthMonitor\Domain\HealthStatusEnum;
use Ramsey\Uuid\UuidInterface;

class SpecificHealthMonitorService implements ReadHealthStateService
{

    public function readStatus(UuidInterface $patientId): HealthStatusEnum
    {
        // here should be example implementation of reading from sth...
        return HealthStatusEnum::POSITIVE;
    }
}
