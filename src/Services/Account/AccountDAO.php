<?php
declare(strict_types=1);

namespace App\Services\Account;

use MongoDB;
use App\Services\Core\Database\DAO;

class AccountDAO extends DAO
{
    protected const COLLECTION = 'accounts';

    public function create(AccountDTO $account): void
    {
        $this->insert([
            'email' => $account->getEmail(),
            'pseudo' => $account->getPseudo(),
            'password' => $account->getPassword(),
        ]);
    }

    public function isEmailAlreadyExisting(string $email):bool
    {
        return $this->exists(['email' => $email]);
    }

    public function isPseudoAlreadyExisting(string $pseudo):bool
    {
        return $this->exists(['pseudo' => $pseudo]);

    }
}
