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

    public function addCertificationId(
        AccountDTO $account,
        string $certificationId
    ): void {
        $this->update(
            ['email' => $account->getEmail()],
            ['certificationId' => $certificationId]
        );
    }

    public function certify(string $certificationId): void
    {
        $this->update(
            ['certificationId' => $certificationId],
            ['isCertified' => true]
        );
    }

    public function isEmailAlreadyExisting(string $email):bool
    {
        return $this->exists(['email' => $email]);
    }

    public function isPseudoAlreadyExisting(string $pseudo):bool
    {
        return $this->exists(['pseudo' => $pseudo]);
    }

    public function hasAccountWithCertificationId(string $certificationId): bool
    {
        return $this->exists(['certificationId' => $certificationId]);
    }

    public function getFromEmail(string $email): AccountDTO
    {
        $account = $this->getCollection()->findOne(['email' => $email]);
        return new AccountDTO(
            $account['email'],
            $account['pseudo'],
            $account['password']
        );
    }
}
