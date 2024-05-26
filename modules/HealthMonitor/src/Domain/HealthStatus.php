<?php

namespace Modules\HealthMonitor\Domain;

enum HealthStatus: int
{
    case POSITIVE = 1;
    case NEGATIVE = 0;
}
