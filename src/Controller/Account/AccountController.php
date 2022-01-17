<?php
declare(strict_types = 1);
namespace App\Controller\Account;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AccountController extends AbstractController
{
    /**
     * @Route("/account/create", name="account_creation")
     */
    public function display(): Response
    {
       return $this->render('base/base.html.twig', ['files'=> ['accountCreationPage']]);
    }
}