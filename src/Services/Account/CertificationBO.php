<?php

namespace App\Services\Account;

use App\Services\Core\Mail\Mailer;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Uid\Uuid;

class CertificationBO
{
    private Mailer $mailer;
    private AccountDAO $accountDAO;
    private UrlGeneratorInterface $urlGenerator;

    public function __construct(Mailer $mailer, AccountDAO $accountDAO, UrlGeneratorInterface $urlGenerator)
    {
        $this->mailer = $mailer;
        $this->accountDAO = $accountDAO;
        $this->urlGenerator = $urlGenerator;
    }

    public function askForCertification(AccountDTO $account): void
    {
        $certificationId = Uuid::v4()->toBase58();
        $this->accountDAO->addCertificationId($account, $certificationId);
        $this->mailer->send(
            $account->getEmail(),
            'Verification de votre compte Dardael Sport',
            'Pour valider votre compte, veuillez cliquer sur le lien suivant: '
            . $this->urlGenerator->generate(
                'account_certify',
                ['certificationId' => $certificationId],
                UrlGeneratorInterface::ABSOLUTE_URL
            )
        );
    }

    public function certify(string $certificationId): void
    {
        if (!$this->accountDAO->hasAccountWithCertificationId($certificationId)) {
            throw new \UnexpectedValueException('No account to validate found');
        }
        $this->accountDAO->certify($certificationId);
    }
}
