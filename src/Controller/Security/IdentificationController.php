<?php
declare(strict_types = 1);
// src/Controller/Security/IdentificationController.php
namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IdentificationController extends AbstractController
{
    /**
     * @Route("/", name="identification")
     */
    public function display(): Response
    {
       return $this->render('base/base.html.twig');
    }
}