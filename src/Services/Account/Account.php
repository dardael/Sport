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
            $errors['email'] = 'Mail cannot be empty';
		}
		if (empty($pseudo)) {
            $errors['pseudo'] = 'Pseudo cannot be empty';
		}
		if (empty($password)) {
            $errors['password'] = 'Password cannot be empty';
		}
		if ($repetedPassword !== $password) {
            $errors['repeted-password']
                = 'Password and repeted password cannot be different';
        }
        return $errors;
    }
}
