<?php

namespace Modules\HealthMonitor\Infrastructure;

use Modules\HealthMonitor\Domain\HealthReport;
use Modules\HealthMonitor\Domain\HealthReportRepository;
use Ramsey\Uuid\UuidInterface;

class HealthReportEloquentRepository implements HealthReportRepository
{

    public function load(UuidInterface $id): HealthReport
    {
        // TODO: Implement load() method.
    }

    public function create(HealthReport $report): void
    {
        // TODO: Implement create() method.
    }

    public function update(HealthReport $report): void
    {
        // TODO: Implement update() method.
    }
}
