<?php
declare(strict_types=1);

namespace App\Services\Account;

class AccountDTO
{
    private string $email;
    private string $pseudo;
    private string $password;
    private ?string $repeatedPassword;

    public function __construct(
        string  $email,
        string  $pseudo,
        string  $password,
        ?string $repeatedPassword
    ){
        $this->email = $email;
        $this->pseudo = $pseudo;
        $this->password = $password;
        $this->repeatedPassword = $repeatedPassword;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRepeatedPassword(): ?string
    {
        return $this->repeatedPassword;
    }
}
