<?php

namespace Modules\HealthMonitor\Services;

use Modules\HealthMonitor\Domain\HealthStatus;
use Modules\HealthMonitor\Domain\PatientId;
use Ramsey\Uuid\UuidInterface;

interface ReadHealthStateService
{
    public function readStatus(PatientId $patientId): HealthStatus;
}
