<?php
declare(strict_types = 1);
namespace App\Controller\Account;

use App\Services\Account\AccountBO;
use App\Services\Account\AccountDTO;
use App\Services\Account\CertificationBO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AccountController extends AbstractController
{
    /**
     * @Route("/account/create", name="account_creation")
     */
    public function display(): Response
    {
       return $this->render('base/base.html.twig', ['files'=> ['accountCreationPage']]);
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
			return $this->render(
				'base/base.html.twig',
				[
					'files' => ['accountCreationPage'],
					'variables' => [
						'email' => $request->query->get('email'),
            			'pseudo' => $request->query->get('pseudo'),
					]
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
}
