<?php

namespace App\Services\Core\User;

use App\Services\Account\AccountBO;
use App\Services\Account\AccountDTO;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class UserBO
{
    private SessionInterface $session;
    private AccountBO $accountBO;

    public function __construct(RequestStack $requestStack, AccountBO $accountBO)
    {
        $this->session = $requestStack->getSession();
        $this->accountBO = $accountBO;
    }

    public function connect(string $email, string $password): void
    {
        $isConnectionValid = $this->accountBO->isConnectionValid(
            $email,
            $password
        );
        if (!$isConnectionValid) {
            throw new \OAuthException(
                'Cannot connecte due to wrong password or email'
            );
        }
        $this->session->set('user', $this->accountBO->getAccount($email));
    }

    public function authenticate(): void
    {
        $user = $this->session->get('user');
        $isConnectionValid = $this->accountBO->isConnectionValid(
            $user->getEmail(),
            $user->getPassword()
        );
        if (!$isConnectionValid) {
            throw new \OAuthException('Access unauthorized');
        }
    }
}
