<?php
declare(strict_types = 1);
namespace App\Services\Core\Error;

class InputsErrors
{
    private static array $errorByField = [];

    public static function add(string $field, string $error): void 
    {
        self::$errorByField[$field] = $error;
    }

    public static function get(): array
    {
        return self::$errorByField;
    }
}
