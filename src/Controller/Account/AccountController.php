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
        $account->create(
            $request->query->get('mail'),
            $request->query->get('pseudo'),
            $request->query->get('password')
        );
        return $this->forward('App\Controller\Security\IdentificationController::display');
    }
}