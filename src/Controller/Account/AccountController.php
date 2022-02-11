<?php
declare(strict_types = 1);
namespace App\Controller\Account;

use App\Controller\Core\GenericController;
use App\Services\Account\AccountBO;
use App\Services\Account\AccountDTO;
use App\Services\Account\CertificationBO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AccountController extends GenericController
{
    protected const IS_USER_NEEDED = false;

    /**
     * @Route("/account/create", name="account_creation")
     */
    public function displayCreationScreen(): Response
    {
       return $this->getRenderResponse('accountCreationPage');
    }

    /**
     * @Route("/account/save", name="account_save")
     */
    public function save(Request $request, AccountBO $account): Response
    {  
		try {
			$account->create(new AccountDTO(
            	$request->query->get('email'),
            	$request->query->get('pseudo'),
            	$request->query->get('password'),
            	$request->query->get('repeatedPassword')
            ));
            return $this->redirectToRoute('identification', ['isFromCreation' => true]);

        } catch (\Exception $exception) {
			return $this->getRenderResponse(
                'accountCreationPage',
                [
                    'email' => $request->query->get('email'),
                    'pseudo' => $request->query->get('pseudo'),
                ]
			);
		}
    }

    /**
     * @Route("/account/isValid", name="account_is_valid")
     */
    public function isValid(Request $request, AccountBO $account): Response
    {
        $errors = $account->getFieldsErrors(new AccountDTO(
            $request->get('email'),
            $request->get('pseudo'),
            $request->get('password'),
            $request->get('repeatedPassword')
        ));
        return $this->json($errors);
    }

    /**
     * @Route("/account/certify/{certificationId}", name="account_certify")
     */
    public function certify(
        string $certificationId,
        CertificationBO $certificationBO
    ): Response {
        try {
            $certificationBO->certify($certificationId);
        } catch (\Exception $exception) {
            return $this->redirectToRoute(
                'identification',
                ['isFromInvalidCertification' => true]
            );
        }
        return $this->redirectToRoute(
            'identification',
            ['isFromValidCertification' => true]
        );
    }

    /**
     * @Route("/account/forgotten", name="account_forgotten")
     */
    public function displayForgottenPasswordScreen(Request $request): Response {
        return $this->getRenderResponse(
            'forgottenPasswordPage',
            ['hasError' => $request->query->has('hasError')]
        );
    }

    /**
     * @Route("/account/isExisting", name="account_is_existing")
     */
    public function isExisting(Request $request, AccountBO $account): Response
    {
        $isExisting = $account->isExisting($request->get('email'));
        return $this->json($isExisting);
    }

    /**
     * @Route("/account/sendPassword", name="account_send_password")
     */
    public function sendPassword(Request $request, AccountBO $accountBO): Response {
        try {
            $accountBO->sendPassword($request->get('email'));
        } catch (\Exception $exception) {
            return $this->redirectToRoute(
                'account_forgotten',
                ['hasError' => true]
            );
        }
        return $this->redirectToRoute(
            'identification',
            ['isFromForgottenEmail' => true]
        );
    }

}
