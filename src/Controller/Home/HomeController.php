<?php

declare(strict_types = 1);

namespace App\Controller\Home;

use App\Services\Account\AccountBO;
use App\Services\Core\User\UserBO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home_display")
     */
    public function display(UserBO $userBO): Response
    {
        $userBO->authenticate();
        return $this->render(
            'base/base.html.twig',
            [
                'files' => ['homePage'],
                'variables' => [
                    'pseudo' => $userBO->getUserPseudo(),
                    'selectedHomeLinkKey' => 'home',
                ]
            ]
        );
    }
}
