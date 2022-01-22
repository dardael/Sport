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
		if (empty($mail)) {
			throw new \UnexpectedValueException('Mail cannot be empty');
		}
		if (empty($pseudo)) {
			throw new \UnexpectedValueException('Pseudo cannot be empty');
		}
		if (empty($password)) {
			throw new \UnexpectedValueException('Password cannot be empty');
		}
		if ($repetedPassword !== $password) {
			throw new \UnexpectedValueException(
				'Password and repeted password cannot be different'
			); 	
		}
		$this->accountDAO->create($mail, $pseudo, $password);
    }
}
