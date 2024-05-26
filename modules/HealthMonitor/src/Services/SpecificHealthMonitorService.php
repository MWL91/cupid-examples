<?php

namespace Modules\HealthMonitor\Services;

use Modules\HealthMonitor\Domain\HealthStatus;
use Modules\HealthMonitor\Domain\PatientId;

class SpecificHealthMonitorService implements ReadHealthStateService
{

    public function readStatus(PatientId $patientId): HealthStatus
    {
        // here should be example implementation of reading from sth...
        return HealthStatus::POSITIVE;
    }
}
