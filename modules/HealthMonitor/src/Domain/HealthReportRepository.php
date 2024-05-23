<?php

namespace Modules\HealthMonitor\Domain;

use Ramsey\Uuid\UuidInterface;

interface HealthReportRepository
{

    public function load(UuidInterface $id): HealthReport;

    public function create(HealthReport $report): void;

    public function update(HealthReport $report): void;
}
