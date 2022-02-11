<?php

declare(strict_types = 1);

namespace App\Controller\Home;

use App\Controller\Core\GenericController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends GenericController
{
    /**
     * @Route("/home", name="home_display")
     */
    public function display(): Response
    {
        return $this->getRenderResponse(
            'homePage',
            [
                'pseudo' => $this->userBO->getUserPseudo(),
                'selectedHomeLinkKey' => 'home',
            ]
        );
    }
}
