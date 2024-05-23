<?php

namespace Modules\HealthMonitor\Application\CreateHealthReport;

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
        $report = $this->repository->load($command->getId());

        $report->checkStatus($this->service, $command->getPatientId());

        $this->repository->create($report);
    }
}
