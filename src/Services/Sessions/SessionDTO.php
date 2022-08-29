<?php
declare(strict_types=1);

namespace App\Services\Sessions;

class SessionDTO
{
    public int $id;
    public float $value;
    public int $sessionTypeId;
    public string $date;

    public function __construct(
        int $id,
        float $value,
        int $sessionTypeId,
        string $date
    ) {
        $this->id = $id;
        $this->value = $value;
        $this->sessionTypeId = $sessionTypeId;
        $this->date = $date;
    }
}
