<?php

namespace Modules\HealthMonitor\Tests;

use Illuminate\Support\Facades\Auth;
use Mockery\Mock;
use Modules\HealthMonitor\Application\CreateHealthReport\CreateHealthReportCommand;
use Modules\HealthMonitor\Application\CreateHealthReport\CreateHealthReportCommandHandler;
use Modules\HealthMonitor\Domain\HealthReport;
use Modules\HealthMonitor\Domain\HealthReportRepository;
use Modules\HealthMonitor\Domain\HealthStatusEnum;
use Modules\HealthMonitor\Services\ReadHealthStateService;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CreateReportTest extends TestCase
{
    public function testShouldCreateReport(): void
    {
        // Given:
        $command = new CreateHealthReportCommand(
            $id = Uuid::uuid4(),
            $patientId = Uuid::uuid4()
        );
        $report = new HealthReport($id);

        $repository = $this->createMock(HealthReportRepository::class);
        $repository->expects($this->once())
            ->method('load')
            ->willReturn($report);

        $service = $this->createMock(ReadHealthStateService::class);
        $service->expects($this->once())
            ->method('readStatus')
            ->willReturn(HealthStatusEnum::POSITIVE);

        $handler = new CreateHealthReportCommandHandler(
            $repository,
            $service
        );

        // When:
        $handler($command);

        // Then:
        // ... nothing because mocks only!


        Auth::user();


    }
}
