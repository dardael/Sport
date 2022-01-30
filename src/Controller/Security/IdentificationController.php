<?php
declare(strict_types = 1);
// src/Controller/Security/IdentificationController.php
namespace App\Controller\Security;

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
                ]
            ]
        );
    }
}
