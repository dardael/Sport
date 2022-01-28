<?php
declare(strict_types = 1);
namespace App\Controller\Account;

use App\Services\Account\Account;
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
    public function save(Request $request, Account $account): Response
    {  
		try {
			$account->create(
            	$request->query->get('email'),
            	$request->query->get('pseudo'),
            	$request->query->get('password'),
            	$request->query->get('repeted-password')
        	);
        	return $this->forward(
				'App\Controller\Security\IdentificationController::display'
			);
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
    public function isValid(Request $request, Account $account): Response
    {
        $errors = $account->getFieldsErrors(
            $request->get('email'),
            $request->get('pseudo'),
            $request->get('password'),
            $request->get('repetedPassword')
        );
        return $this->json($errors);
    }
}
