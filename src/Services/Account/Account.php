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

	public function create(
		string $mail,
		string $pseudo,
		string $password,
		string $repetedPassword
    ): void {
        $errors = $this->getFieldsErrors(
            $mail,
            $pseudo,
            $password,
            $repetedPassword
        );
        if (!empty($errors)) {
            throw new \UnexpectedValueException(
                array_shift($errors)
            );
        }
		$this->accountDAO->create($mail, $pseudo, $password);
    }

    public function getFieldsErrors(
        string $mail,
		string $pseudo,
		string $password,
		string $repetedPassword
    ): array {
        $errors = [];
        if (empty($mail)) {
            $errors['email'] = CreationErrors::EMAIL_IS_EMPTY->value;
		}
		if (empty($pseudo)) {
            $errors['pseudo'] = CreationErrors::PSEUDO_IS_EMPTY->value;
		}
		if (empty($password)) {
            $errors['password'] = CreationErrors::PASSWORD_IS_EMPTY->value;
		}
		if ($repetedPassword !== $password) {
            $errors['repeted-password'] = CreationErrors::REPEATED_PASSWORD_DIFFERENT->value;
        }
        return $errors;
    }
}
