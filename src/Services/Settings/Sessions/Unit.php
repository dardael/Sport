<?php
declare(strict_types=1);

namespace App\Services\Settings\Sessions;

enum Unit: string
{
    case rep = 'rep';
    case min = 'min';
    case sec = 'sec';
}
