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
        private UuidInterface $id,
        private ?HealthStatusEnum $status = null,
        private ?CarbonInterface $created_at = null
    )
    {
        if($this->created_at === null) {
            $this->created_at = CarbonImmutable::now();
        }
    }

    public function checkStatus(ReadHealthStateService $service, UuidInterface $patientId): void
    {
        $this->status = $service->readStatus($patientId);
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
