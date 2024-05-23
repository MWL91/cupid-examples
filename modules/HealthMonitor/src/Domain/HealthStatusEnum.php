<?php

namespace Modules\HealthMonitor\Domain;

enum HealthStatusEnum: int
{
    case POSITIVE = 1;
    case NEGATIVE = 0;
}
