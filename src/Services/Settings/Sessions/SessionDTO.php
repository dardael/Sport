<?php
declare(strict_types=1);

namespace App\Services\Settings\Sessions;

class SessionDTO
{
    public int $id;
    public string $exercice;
    public Unit $unit;
    public string $description;
    public string $color;

    public function __construct(
        int $id,
        string $exercice,
        Unit $unit,
        string $description,
        string $color
    ) {
        $this->id = $id;
        $this->exercice = $exercice;
        $this->unit = $unit;
        $this->description = $description;
        $this->color = $color;
    }
}
