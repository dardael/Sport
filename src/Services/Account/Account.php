<?php
declare(strict_types = 1);
namespace App\Services\Account;

use MongoDB;

class Account
{
    private AccountDAO $accountDAO;
    public function __construct(AccountDAO $accountDAO)  {
        $this->accountDAO = $accountDAO;
    }

    public function create(string $mail, string $pseudo, string $password): void
    {
        $this->accountDAO->create($mail, $pseudo, $password);
    }
}