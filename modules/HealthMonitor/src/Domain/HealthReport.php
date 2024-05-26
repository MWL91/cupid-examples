<?php

namespace Modules\HealthMonitor\Domain;

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Contracts\Support\Arrayable;
use Modules\HealthMonitor\Services\ReadHealthStateService;
use Ramsey\Uuid\UuidInterface;

final class HealthReport implements Arrayable
{
    public function __construct(
        private HealthReportId   $id,
        private PatientId        $patientId,
        private ?HealthStatus    $status = null,
        private ?HealthReportCreateDate $created_at = null
    )
    {
        if($this->created_at === null) {
            $this->created_at = HealthReportCreateDate::now();
        }
    }

    public function checkStatus(ReadHealthStateService $service): void
    {
        if($this->created_at->isOlderThanOneDay()) {
            throw new \Exception('Cannot check status for old report');
        }

        if($this->status !== null) {
            throw new \Exception('Status already checked');
        }

        $this->status = $service->readStatus($this->patientId);
    }

    public function toArray()
    {
        return [
            'id' => $this->id->toString(),
            'status' => $this->status->value,
            'created_at' => $this->created_at->toString()
        ];
    }
}
