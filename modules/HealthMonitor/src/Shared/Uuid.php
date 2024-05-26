<?php

namespace Modules\HealthMonitor\Shared;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\UuidInterface;

abstract class Uuid
{
    public function __construct(protected UuidInterface $id)
    {
    }

    public static function generate(): self
    {
        return new static(RamseyUuid::uuid4());
    }

    public static function fromString(string $id): static
    {
        return new static(RamseyUuid::fromString($id));
    }

    public function __toString(): string
    {
        return $this->id->toString();
    }
}
