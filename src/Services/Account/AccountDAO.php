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
            'mail' => $account->getEmail(),
            'pseudo' => $account->getPseudo(),
            'password' => $account->getPassword(),
        ]);
    }
}
