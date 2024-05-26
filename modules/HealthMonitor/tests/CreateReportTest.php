<?php

namespace Modules\HealthMonitor\Tests;

use Illuminate\Support\Facades\Auth;
use Mockery\Mock;
use Modules\HealthMonitor\Application\CreateHealthReport\CreateHealthReportCommand;
use Modules\HealthMonitor\Application\CreateHealthReport\CreateHealthReportCommandHandler;
use Modules\HealthMonitor\Domain\HealthReport;
use Modules\HealthMonitor\Domain\HealthReportId;
use Modules\HealthMonitor\Domain\HealthReportRepository;
use Modules\HealthMonitor\Domain\HealthStatus;
use Modules\HealthMonitor\Domain\PatientId;
use Modules\HealthMonitor\Services\ReadHealthStateService;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CreateReportTest extends TestCase
{
    public function testShouldCreateReport(): void
    {
        // Given:
        $command = new CreateHealthReportCommand(
            $id = HealthReportId::generate(),
            $patientId = PatientId::generate()
        );
        $report = new HealthReport($id, $patientId);

        $repository = $this->createMock(HealthReportRepository::class);
        $repository->expects($this->once())
            ->method('create');

        $service = $this->createMock(ReadHealthStateService::class);
        $service->expects($this->once())
            ->method('readStatus')
            ->willReturn(HealthStatus::POSITIVE);

        $handler = new CreateHealthReportCommandHandler(
            $repository,
            $service
        );

        // When:
        $handler($command);

        // Then:
        // ... nothing because mocks only!
    }
}
