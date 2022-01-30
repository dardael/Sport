<?php
declare(strict_types = 1);
namespace App\Services\Account;

class AccountBO
{
    private AccountDAO $accountDAO;
    public function __construct(AccountDAO $accountDAO)  {
        $this->accountDAO = $accountDAO;
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
    }

    public function getFieldsErrors(
        AccountDTO $account
    ): array {
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
            $errors['repeatedPassword'] = CreationErrors::REPEATED_PASSWORD_DIFFERENT->value;
        }
        if(
            empty($errors['email'])
            && $this->accountDAO->isEmailAlreadyExisting($account->getEmail())
        ){
            $errors['email'] = CreationErrors::EMAIL_IS_EXISTING->value;
        }
        if(
            empty($errors['pseudo'])
            && $this->accountDAO->isPseudoAlreadyExisting($account->getPseudo())
        ){
            $errors['pseudo'] = CreationErrors::PSEUDO_IS_EXISTING->value;
        }
        return $errors;
    }
}
