<?php

namespace Modules\HealthMonitor\Application\CreateHealthReport;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class CreateHealthReportCommand
{
    public function __construct(
        private string $id,
        private string $patientId
    ) {
    }

    public function getId(): UuidInterface
    {
        return Uuid::fromString($this->id);
    }

    public function getPatientId(): UuidInterface
    {
        return Uuid::fromString($this->patientId);
    }
}
