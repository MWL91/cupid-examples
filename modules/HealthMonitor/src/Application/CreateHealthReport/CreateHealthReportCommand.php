<?php

namespace Modules\HealthMonitor\Application\CreateHealthReport;

use Modules\HealthMonitor\Domain\HealthReportId;
use Modules\HealthMonitor\Domain\PatientId;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class CreateHealthReportCommand
{
    public function __construct(
        private string $id,
        private string $patientId
    ) {
    }

    public function getId(): HealthReportId
    {
        return HealthReportId::fromString($this->id);
    }

    public function getPatientId(): PatientId
    {
        return PatientId::fromString($this->patientId);
    }
}
