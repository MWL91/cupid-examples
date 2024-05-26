<?php

namespace Modules\HealthMonitor\Application\CreateHealthReport;

use Modules\HealthMonitor\Domain\HealthReport;
use Modules\HealthMonitor\Domain\HealthReportRepository;
use Modules\HealthMonitor\Services\ReadHealthStateService;

class CreateHealthReportCommandHandler
{
    public function __construct(
        private HealthReportRepository $repository,
        private ReadHealthStateService $service
    )
    {
    }

    public function __invoke(CreateHealthReportCommand $command): void
    {
        $report = new HealthReport(
            $command->getId(),
            $command->getPatientId()
        );

        $report->checkStatus($this->service);

        $this->repository->create($report);
    }
}
