<?php 

declare(strict_types=1);

namespace App\Tests\Unit\Services\Account;

use App\Services\Account\AccountDTO;
use App\Services\Account\CreationErrors;
use PHPUnit\Framework\TestCase;
use App\Services\Account\AccountBO;
use App\Services\Account\AccountDAO;

class AccountTest extends TestCase
{
    /**
     * @test
     **/ 	
    public function create_throws_an_exeption_when_pseudo_is_empty():void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->expects($this->never())->method('create');
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(CreationErrors::PSEUDO_IS_EMPTY->value);
        $account = new AccountDTO('amail@coco.com', '', 'mdp', 'mdp');
        (new AccountBO($accountDAO))->create($account);
    }
    
    /**
     * @test
     **/ 	
    public function create_throws_an_exeption_when_mail_is_empty():void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->expects($this->never())->method('create');
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(CreationErrors::EMAIL_IS_EMPTY->value);
        $account = new AccountDTO('', 'dardael', 'mdp', 'mdp');
        (new AccountBO($accountDAO))->create($account);
    }
    
    /**
     * @test
     **/ 	
    public function create_throws_an_exeption_when_password_is_empty():void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->expects($this->never())->method('create');
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(CreationErrors::PASSWORD_IS_EMPTY->value);
        $account = new AccountDTO('itsamail@coco.fr', 'dardael', '', 'mdp');
        (new AccountBO($accountDAO))->create($account);
    } 
    
    /**
     * @test
     **/ 	
    public function create_throws_an_exeption_when_password_and_and_repeted_password_are_different():void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->expects($this->never())->method('create');
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(CreationErrors::REPEATED_PASSWORD_DIFFERENT->value);
        $account = new AccountDTO('itsamail@coco.fr', 'dardael', 'mdp', 'anotherMdp');
        (new AccountBO($accountDAO))->create($account);
    }

    /**
     * @test
     **/ 	
    public function create_creates_the_account_when_all_information_are_good(): void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->expects($this->once())->method('create');
        $account = new AccountDTO('itsamail@coco.fr', 'dardael', 'mdp', 'mdp');
        (new AccountBO($accountDAO))->create($account);
    }
   
    /**
     * @test
     **/ 	
    public function getFieldsErrors_returns_empty_when_there_is_no_error(): void
    {
        $accountDAO = $this->getAccountDAOMock();
        $account = new AccountDTO(
            'itsamail@coco.fr',
            'dardael',
            'mdp',
            'mdp'
        );
        $this->assertEquals(
            [],
            (new AccountBO($accountDAO))->getFieldsErrors($account)
        );
    }

    /**
     * @test
     **/ 	
    public function getFieldsErrors_returns_repeted_password_in_error_when_different_than_password(): void
    {
        $accountDAO = $this->getAccountDAOMock();
        $account = new AccountDTO(
            'itsamail@coco.fr',
            'dardael',
            'mdp',
            'mdp2'
        );
        $this->assertEquals(
            [ 'repeted-password' => 'Password and repeted password cannot be different'],
            (new AccountBO($accountDAO))->getFieldsErrors($account)
        );
    }

     /**
     * @test
     **/ 	
    public function getFieldsErrors_returns_password_in_error_when_empty(): void
    {
        $accountDAO = $this->getAccountDAOMock();
        $account = new AccountDTO(
            'itsamail@coco.fr',
            'dardael',
            '',
            ''
        );
        $this->assertEquals(
            ['password' => 'Password cannot be empty'],
            (new AccountBO($accountDAO))->getFieldsErrors($account)
        );
    }

    /**
     * @test
     **/ 	
    public function getFieldsErrors_returns_pseudo_in_error_when_empty(): void
    {
        $accountDAO = $this->getAccountDAOMock();
        $account = new AccountDTO(
            'itsamail@coco.fr',
            '',
            'mdp',
            'mdp'
        );
        $this->assertEquals(
            ['pseudo' => 'Pseudo cannot be empty'],
            (new AccountBO($accountDAO))->getFieldsErrors($account)
        );
    }
    
    /**
     * @test
     **/ 	
    public function getFieldsErrors_returns_email_in_error_when_empty(): void
    {
        $accountDAO = $this->getAccountDAOMock();
        $account = new AccountDTO(
            '',
            'dardael',
            'mdp',
            'mdp'
        );
        $this->assertEquals(
            ['email' => 'Mail cannot be empty'],
            (new AccountBO($accountDAO))->getFieldsErrors($account)
        );
    }
    
    /**
     * @test
     **/ 	
    public function getFieldsErrors_can_returns_all_errors_at_the_same_time(): void
    {
        $accountDAO = $this->getAccountDAOMock();
        $account = new AccountDTO(
            '',
            '',
            '',
            'mdp'
        );
        $this->assertEquals(
            [
                'email' => 'Mail cannot be empty',
                'pseudo' => 'Pseudo cannot be empty',
                'password' => 'Password cannot be empty',
                'repeted-password'
                => 'Password and repeted password cannot be different',
            ],
            (new AccountBO($accountDAO))->getFieldsErrors($account)
        );
    }

    private function getAccountDAOMock(): AccountDAO
    {
        return $this->getMockBuilder(AccountDAO::class)
        ->setMethods(['create'])
        ->getMock();
    }

}
