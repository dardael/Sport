<?php

declare(strict_types = 1);

namespace App\Controller\Home;

use App\Controller\Core\GenericController;
use App\Services\Sessions\SessionsBO;
use App\Services\Settings\Sessions\SessionsBO as SessionTypesBO;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends GenericController
{
    protected const MENU_CODE = 'home';

    /**
     * @Route("/home", name="home_display")
     */
    public function display(SessionsBO $sessionsBO, SessionTypesBO $sessionTypesBO): Response
    {
        $sessions = $sessionsBO->getSessions($this->userBO->getUserPseudo());
        $sessionTypes = $sessionTypesBO->getSessions($this->userBO->getUserPseudo());
        return $this->getRenderResponse(
            'homePage',
            ['sessions' => $sessions, 'sessionTypes' => $sessionTypes]
        );
    }
}
