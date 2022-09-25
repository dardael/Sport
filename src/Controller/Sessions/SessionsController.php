<?php

declare(strict_types = 1);

namespace App\Controller\Sessions;

use App\Controller\Core\GenericController;
use App\Services\Sessions\SessionsBO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Settings\Sessions\SessionsBO as SessionTypesBO;
class SessionsController extends GenericController
{
    protected const MENU_CODE = 'sessions';

    /**
     * @Route("/sessions", name="sessions_display")
     */
    public function display(
        SessionsBO $sessionsBO,
        SessionTypesBO $sessionTypesBO
    ): Response {
        $sessions = $sessionsBO->getSessions($this->userBO->getUserPseudo());
        $sessionTypes = $sessionTypesBO->getSessions($this->userBO->getUserPseudo());
        return $this->getRenderResponse(
            'sessionsPage',
            ['sessions' => $sessions, 'sessionTypes' => $sessionTypes]
        );
    }

    /**
     *
     * @Route("/sessions/save", name="sessions_save")
     */
    public function save(Request $request, SessionsBo $sessionsBo): Response
    {
        $sessions = $request->get('sessions');
        $sessionsBo->saveSessions($this->userBO->getUserPseudo(), $sessions?:[]);
        return $this->json(true);
    }

}
