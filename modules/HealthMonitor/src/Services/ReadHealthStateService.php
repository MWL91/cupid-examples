<?php

namespace Modules\HealthMonitor\Services;

use Modules\HealthMonitor\Domain\HealthStatusEnum;
use Ramsey\Uuid\UuidInterface;

interface ReadHealthStateService
{
    public function readStatus(UuidInterface $patientId): HealthStatusEnum;
}
