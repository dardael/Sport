<?php

declare(strict_types = 1);

namespace App\Controller\Sessions;

use App\Controller\Core\GenericController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Settings\Sessions\SessionsBO as SessionTypesBO;
class SessionsController extends GenericController
{
    protected const MENU_CODE = 'sessions';

    /**
     * @Route("/sessions", name="sessions_display")
     */
    public function display(SessionTypesBO $sessionTypesBO): Response
    {
        $sessionTypes = $sessionTypesBO->getSessions($this->userBO->getUserPseudo());
        return $this->getRenderResponse(
            'sessionsPage',
            ['sessionTypes' => $sessionTypes, 'sessions' => []]
        );
    }
}
