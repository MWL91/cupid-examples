<?php

namespace Modules\HealthMonitor\Domain;

class HealthReportCreateDate
{
    public function __construct(private \DateTimeImmutable $date)
    {
    }

    public static function now(): self
    {
        return new self(new \DateTimeImmutable());
    }

    public function __toString(): string
    {
        return $this->date->format('Y-m-d H:i:s');
    }

    public function diffInMinutes(HealthReportCreateDate $now): int
    {
        return $this->date->diff($now->date)->i;
    }

    public function isOlderThanOneDay(): bool
    {
        return $this->date->diff(new \DateTimeImmutable())->days > 1;
    }
}
