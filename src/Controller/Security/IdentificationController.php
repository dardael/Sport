<?php
declare(strict_types = 1);
// src/Controller/Security/IdentificationController.php
namespace App\Controller\Security;

use App\Services\Account\AccountBO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IdentificationController extends AbstractController
{
    /**
     * @Route("/", name="identification")
     */
    public function display(Request $request): Response
    {
        return $this->render(
            'base/base.html.twig',
            [
                'files' => ['authenticatePage'],
                'variables' => [
                    'isFromCreation' => $request->query->has('isFromCreation'),
                    'isFromInvalidCertification'
                        => $request->query->has('isFromInvalidCertification'),
                    'isFromValidCertification'
                        => $request->query->has('isFromValidCertification'),
                    'isFromForgottenEmail'
                        => $request->query->has('isFromForgottenEmail'),
                    'isFromInvalidConnection'
                        => $request->query->has('isFromInvalidConnection'),
                ]
            ]
        );
    }

    /**
     * @Route("/isConnectionValid", name="isConnectionValid")
     */
    public function isConnectionValid(Request $request, AccountBO $accountBO): Response
    {
        $isConnectionValid = $accountBO->isConnectionValid(
            $request->get('email'),
            $request->get('password')
        );
        return $this->json($isConnectionValid);
    }

    /**
     * @Route("/connect", name="connect")
     */
    public function connect(Request $request, AccountBO $accountBO): Response
    {
        $isConnectionValid = $accountBO->isConnectionValid(
            $request->get('email'),
            $request->get('password')
        );
        if ($isConnectionValid) {
            //on va vers la home
        } else {
            return $this->redirectToRoute(
                'identification',
                ['isFromInvalidConnection' => true]
            );
        }
    }
}
