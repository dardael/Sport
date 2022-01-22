<?php
declare(strict_types = 1);
namespace App\Services\Account;

use MongoDB;
use App\Services\Core\Database\DAO;

class AccountDAO extends DAO
{
    protected const COLLECTION = 'accounts';
    public function create(string $mail, string $pseudo, string $password): void
    {
        $this->insert(['mail' => $mail, 'pseudo' => $pseudo, 'password' => $password,]);
    }
}