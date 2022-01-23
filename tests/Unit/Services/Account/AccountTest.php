<?php 

declare(strict_types=1);

namespace App\Tests\Unit\Services\Account;

use PHPUnit\Framework\TestCase;
use App\Services\Account\Account;
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
        $this->expectExceptionMessage('Pseudo cannot be empty');
        (new Account($accountDAO))->create('amail@coco.com', '', 'mdp', 'mdp');
    }
    
    /**
     * @test
     **/ 	
    public function create_throws_an_exeption_when_mail_is_empty():void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->expects($this->never())->method('create');
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage('Mail cannot be empty');
        (new Account($accountDAO))->create('', 'dardael', 'mdp', 'mdp');
    }
    
    /**
     * @test
     **/ 	
    public function create_throws_an_exeption_when_password_is_empty():void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->expects($this->never())->method('create');
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage('Password cannot be empty');
        (new Account($accountDAO))->create('itsamail@coco.fr', 'dardael', '', 'mdp');
    } 
    
    /**
     * @test
     **/ 	
    public function create_throws_an_exeption_when_password_and_and_repeted_password_are_different():void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->expects($this->never())->method('create');
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage('Password and repeted password cannot be different');
        (new Account($accountDAO))->create('itsamail@coco.fr', 'dardael', 'mdp', 'anotherMdp');
    }

    /**
     * @test
     **/ 	
    public function create_creates_the_account_when_all_information_are_good():void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->expects($this->once())->method('create');
        (new Account($accountDAO))->create('itsamail@coco.fr', 'dardael', 'mdp', 'mdp');
    }

    private function getAccountDAOMock(): AccountDAO
    {
        return $this->getMockBuilder(AccountDAO::class)
        ->setMethods(['create'])
        ->getMock();
    }

}