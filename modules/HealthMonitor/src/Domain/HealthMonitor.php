<?php

namespace Modules\HealthMonitor\Domain;

final class HealthMonitor
{
    private array $reports = [];
    private ?Order $order = null;

    public function __construct(
        private \DateTimeImmutable $created_at
    )
    {
    }

    public function attachReport(HealthReport $report): void
    {
        if(!$report->isCreatedAt($this->created_at)) {
            throw new \OutOfRangeException('Cannot attach report from different day');
        }

        $this->reports[] = $report;
    }

    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }

    public function getResult(): bool
    {
        if(!$this->order->isPaid()) {
            throw new \Exception('Order is not paid');
        }

        /** @var HealthReport $report */
        foreach($this->reports as $report) {
            if($report->getStatus() === HealthStatus::NEGATIVE) {
                return false;
            }
        }

        return true;
    }
}
