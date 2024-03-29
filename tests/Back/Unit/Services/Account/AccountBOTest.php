<?php 

declare(strict_types=1);

namespace App\Tests\Back\Unit\Services\Account;

use App\Services\Account\AccountBO;
use App\Services\Account\AccountDAO;
use App\Services\Account\AccountDTO;
use App\Services\Account\CertificationBO;
use App\Services\Account\CreationErrors;
use App\Services\Core\Mail\Mailer;
use PHPUnit\Framework\TestCase;

class AccountBOTest extends TestCase
{
    /**
     * @test
     **/ 	
    public function create_throws_an_exception_when_pseudo_is_empty():void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->expects($this->never())->method('create');
        $accountDAO->method('isEmailAlreadyExisting')->willReturn(false);
        $accountDAO->method('isPseudoAlreadyExisting')->willReturn(false);
        $certifier = $this->getCertificationBOMock();
        $certifier->expects($this->never())->method('askForCertification');
        $mailer = $this->getMailerMock();
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(CreationErrors::PSEUDO_IS_EMPTY->value);
        $account = new AccountDTO('amail@coco.com', '', 'mdp', 'mdp');
        (new AccountBO($accountDAO, $certifier, $mailer))->create($account);
    }
    
    /**
     * @test
     **/ 	
    public function create_throws_an_exception_when_mail_is_empty():void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->expects($this->never())->method('create');
        $accountDAO->method('isEmailAlreadyExisting')->willReturn(false);
        $accountDAO->method('isPseudoAlreadyExisting')->willReturn(false);
        $certifier = $this->getCertificationBOMock();
        $certifier->expects($this->never())->method('askForCertification');
        $mailer = $this->getMailerMock();
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(CreationErrors::EMAIL_IS_EMPTY->value);
        $account = new AccountDTO('', 'dardael', 'mdp', 'mdp');
        (new AccountBO($accountDAO, $certifier, $mailer))->create($account);
    }
    
    /**
     * @test
     **/ 	
    public function create_throws_an_exception_when_password_is_empty():void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->expects($this->never())->method('create');
        $accountDAO->method('isEmailAlreadyExisting')->willReturn(false);
        $accountDAO->method('isPseudoAlreadyExisting')->willReturn(false);
        $certifier = $this->getCertificationBOMock();
        $certifier->expects($this->never())->method('askForCertification');
        $mailer = $this->getMailerMock();
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(CreationErrors::PASSWORD_IS_EMPTY->value);
        $account = new AccountDTO('itsamail@coco.fr', 'dardael', '', 'mdp');
        (new AccountBO($accountDAO, $certifier, $mailer))->create($account);
    } 
    
    /**
     * @test
     **/ 	
    public function create_throws_an_exception_when_password_and_and_repeated_password_are_different():void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->expects($this->never())->method('create');
        $accountDAO->method('isEmailAlreadyExisting')->willReturn(false);
        $accountDAO->method('isPseudoAlreadyExisting')->willReturn(false);
        $certifier = $this->getCertificationBOMock();
        $certifier->expects($this->never())->method('askForCertification');
        $mailer = $this->getMailerMock();
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(CreationErrors::REPEATED_PASSWORD_DIFFERENT->value);
        $account = new AccountDTO('itsamail@coco.fr', 'dardael', 'mdp', 'anotherMdp');
        (new AccountBO($accountDAO, $certifier, $mailer))->create($account);
    }

    /**
     * @test
     **/
    public function create_throws_an_exception_when_mail_already_exists():void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->expects($this->never())->method('create');
        $accountDAO->method('isEmailAlreadyExisting')->willReturn(true);
        $accountDAO->method('isPseudoAlreadyExisting')->willReturn(false);
        $certifier = $this->getCertificationBOMock();
        $certifier->expects($this->never())->method('askForCertification');
        $mailer = $this->getMailerMock();
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(CreationErrors::EMAIL_IS_EXISTING->value);
        $account = new AccountDTO('itsamail@coco.fr', 'dardael', 'mdp', 'mdp');
        (new AccountBO($accountDAO, $certifier, $mailer))->create($account);
    }

    /**
     * @test
     **/
    public function create_throws_an_exception_when_pseudo_already_exists():void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->expects($this->never())->method('create');
        $accountDAO->method('isEmailAlreadyExisting')->willReturn(false);
        $accountDAO->method('isPseudoAlreadyExisting')->willReturn(true);
        $certifier = $this->getCertificationBOMock();
        $certifier->expects($this->never())->method('askForCertification');
        $mailer = $this->getMailerMock();
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(CreationErrors::PSEUDO_IS_EXISTING->value);
        $account = new AccountDTO('itsamail@coco.fr', 'dardael', 'mdp', 'mdp');
        (new AccountBO($accountDAO, $certifier, $mailer))->create($account);
    }

    /**
     * @test
     **/ 	
    public function create_creates_the_account_when_all_information_are_good(): void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->expects($this->once())->method('create');
        $certifier = $this->getCertificationBOMock();
        $certifier->expects($this->once())->method('askForCertification');
        $mailer = $this->getMailerMock();
        $accountDAO->method('isEmailAlreadyExisting')->willReturn(false);
        $accountDAO->method('isPseudoAlreadyExisting')->willReturn(false);
        $account = new AccountDTO('itsamail@coco.fr', 'dardael', 'mdp', 'mdp');
        (new AccountBO($accountDAO, $certifier, $mailer))->create($account);
    }
   
    /**
     * @test
     **/ 	
    public function getFieldsErrors_returns_empty_when_there_is_no_error(): void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->method('isEmailAlreadyExisting')->willReturn(false);
        $accountDAO->method('isPseudoAlreadyExisting')->willReturn(false);
        $account = new AccountDTO(
            'itsamail@coco.fr',
            'dardael',
            'mdp',
            'mdp'
        );
        $this->assertEquals(
            [],
            (new AccountBO($accountDAO, $this->getCertificationBOMock(),$this->getMailerMock()))
                ->getFieldsErrors($account)
        );
    }

    /**
     * @test
     **/ 	
    public function getFieldsErrors_returns_repeated_password_in_error_when_different_than_password(): void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->method('isEmailAlreadyExisting')->willReturn(false);
        $accountDAO->method('isPseudoAlreadyExisting')->willReturn(false);
        $account = new AccountDTO(
            'itsamail@coco.fr',
            'dardael',
            'mdp',
            'mdp2'
        );
        $this->assertEquals(
            [ 'repeatedPassword' => CreationErrors::REPEATED_PASSWORD_DIFFERENT->value],
            (new AccountBO($accountDAO, $this->getCertificationBOMock(), $this->getMailerMock()))
                ->getFieldsErrors($account)
        );
    }

     /**
     * @test
     **/ 	
    public function getFieldsErrors_returns_password_in_error_when_empty(): void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->method('isEmailAlreadyExisting')->willReturn(false);
        $accountDAO->method('isPseudoAlreadyExisting')->willReturn(false);
        $account = new AccountDTO(
            'itsamail@coco.fr',
            'dardael',
            '',
            ''
        );
        $this->assertEquals(
            ['password' => CreationErrors::PASSWORD_IS_EMPTY->value],
            (new AccountBO($accountDAO, $this->getCertificationBOMock(), $this->getMailerMock()))
                ->getFieldsErrors($account)
        );
    }

    /**
     * @test
     **/ 	
    public function getFieldsErrors_returns_pseudo_in_error_when_empty(): void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->method('isEmailAlreadyExisting')->willReturn(false);
        $accountDAO->method('isPseudoAlreadyExisting')->willReturn(false);
        $account = new AccountDTO(
            'itsamail@coco.fr',
            '',
            'mdp',
            'mdp'
        );
        $this->assertEquals(
            ['pseudo' => CreationErrors::PSEUDO_IS_EMPTY->value],
            (new AccountBO($accountDAO, $this->getCertificationBOMock(), $this->getMailerMock()))
                ->getFieldsErrors($account)
        );
    }
    
    /**
     * @test
     **/ 	
    public function getFieldsErrors_returns_email_in_error_when_empty(): void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->method('isEmailAlreadyExisting')->willReturn(false);
        $accountDAO->method('isPseudoAlreadyExisting')->willReturn(false);
        $account = new AccountDTO(
            '',
            'dardael',
            'mdp',
            'mdp'
        );
        $this->assertEquals(
            ['email' => CreationErrors::EMAIL_IS_EMPTY->value],
            (new AccountBO($accountDAO, $this->getCertificationBOMock(), $this->getMailerMock()))
                ->getFieldsErrors($account)
        );
    }

    /**
     * @test
     **/
    public function getFieldsErrors_returns_email_in_error_when_existing(): void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->method('isEmailAlreadyExisting')->willReturn(true);
        $accountDAO->method('isPseudoAlreadyExisting')->willReturn(false);
        $account = new AccountDTO(
            'coucou@gmail.com',
            'dardael',
            'mdp',
            'mdp'
        );
        $this->assertEquals(
            ['email' => CreationErrors::EMAIL_IS_EXISTING->value],
            (new AccountBO($accountDAO, $this->getCertificationBOMock(), $this->getMailerMock()))
                ->getFieldsErrors($account)
        );
    }

    /**
     * @test
     **/
    public function getFieldsErrors_returns_pseudo_in_error_when_existing(): void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->method('isEmailAlreadyExisting')->willReturn(false);
        $accountDAO->method('isPseudoAlreadyExisting')->willReturn(true);
        $account = new AccountDTO(
            'coucou@gmail.com',
            'dardael',
            'mdp',
            'mdp'
        );
        $this->assertEquals(
            ['pseudo' => CreationErrors::PSEUDO_IS_EXISTING->value],
            (new AccountBO($accountDAO, $this->getCertificationBOMock(), $this->getMailerMock()))
                ->getFieldsErrors($account)
        );
    }
    
    /**
     * @test
     **/ 	
    public function getFieldsErrors_can_returns_all_errors_at_the_same_time(): void
    {
        $accountDAO = $this->getAccountDAOMock();
        $accountDAO->method('isEmailAlreadyExisting')->willReturn(false);
        $accountDAO->method('isPseudoAlreadyExisting')->willReturn(false);
        $account = new AccountDTO(
            '',
            '',
            '',
            'mdp'
        );
        $this->assertEquals(
            [
                'email' => CreationErrors::EMAIL_IS_EMPTY->value,
                'pseudo' => CreationErrors::PSEUDO_IS_EMPTY->value,
                'password' => CreationErrors::PASSWORD_IS_EMPTY->value,
                'repeatedPassword'
                    => CreationErrors::REPEATED_PASSWORD_DIFFERENT->value,
            ],
            (new AccountBO($accountDAO, $this->getCertificationBOMock(), $this->getMailerMock()))
                ->getFieldsErrors($account)
        );
    }

    private function getAccountDAOMock(): AccountDAO
    {
        return $this->getMockBuilder(AccountDAO::class)
        ->onlyMethods(['create', 'isEmailAlreadyExisting', 'isPseudoAlreadyExisting'])
        ->getMock();
    }

    private function getCertificationBOMock(): CertificationBO
    {
        return $this->getMockBuilder(CertificationBO::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['askForCertification'])
            ->getMock();
    }

    private function getMailerMock(): Mailer
    {
        return $this->getMockBuilder(Mailer::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
