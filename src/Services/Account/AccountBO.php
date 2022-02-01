<?php
declare(strict_types=1);

namespace App\Services\Account;

use App\Services\Core\Mail\Mailer;

class AccountBO
{
    private AccountDAO $accountDAO;
    private CertificationBO $certifier;
    private Mailer $mailer;

    public function __construct(AccountDAO $accountDAO, CertificationBO $certifier, Mailer $mailer)
    {
        $this->accountDAO = $accountDAO;
        $this->certifier = $certifier;
        $this->mailer = $mailer;
    }

    public function create(AccountDTO $account): void
    {
        $errors = $this->getFieldsErrors($account);
        if (!empty($errors)) {
            throw new \UnexpectedValueException(
                array_shift($errors)
            );
        }
        $this->accountDAO->create($account);
        $this->certifier->askForCertification($account);
    }

    public function getFieldsErrors(AccountDTO $account): array
    {
        $errors = [];
        if (empty($account->getEmail())) {
            $errors['email'] = CreationErrors::EMAIL_IS_EMPTY->value;
        }
        if (empty($account->getPseudo())) {
            $errors['pseudo'] = CreationErrors::PSEUDO_IS_EMPTY->value;
        }
        if (empty($account->getPassword())) {
            $errors['password'] = CreationErrors::PASSWORD_IS_EMPTY->value;
        }
        if ($account->getRepeatedPassword() !== $account->getPassword()) {
            $errors['repeatedPassword'] =
                CreationErrors::REPEATED_PASSWORD_DIFFERENT->value;
        }
        if (
            empty($errors['email'])
            && $this->accountDAO->isEmailAlreadyExisting($account->getEmail())
        ) {
            $errors['email'] = CreationErrors::EMAIL_IS_EXISTING->value;
        }
        if (
            empty($errors['pseudo'])
            && $this->accountDAO->isPseudoAlreadyExisting($account->getPseudo())
        ) {
            $errors['pseudo'] = CreationErrors::PSEUDO_IS_EXISTING->value;
        }
        return $errors;
    }

    public function isExisting(string $email): bool
    {
        return $this->accountDAO->isEmailAlreadyExisting($email);
    }

    public function sendPassword(string $email): void
    {
        $account = $this->accountDAO->getFromEmail($email);
        $this->mailer->send(
            $account->getEmail(),
            'Mots de passe de votre compte Dardael Sport oublié',
            'Voici votre mots de passe : ' . $account->getPassword()
        );
    }
}
