<?php

declare(strict_types = 1);

namespace App\Controller\Settings\Sessions;

use App\Controller\Core\GenericController;
use App\Services\Settings\Sessions\SessionsBO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionsController extends GenericController
{
    protected const MENU_CODE = 'sessionSettings';

    /**
     * @Route("/sessions/settings", name="sessions_settings_display")
     */
    public function display(SessionsBO $sessionsBO): Response
    {
        $sessions = $sessionsBO->getSessions($this->userBO->getUserPseudo());
        return $this->getRenderResponse(
            'settingsSessionsPage',
            ['sessions' => $sessions]
        );
    }

    /**
     *
     * @Route("/sessions/settings/save", name="sessions_settings_save")
     */
    public function save(Request $request, SessionsBO $sessionsBO): Response
    {
        $sessionsBO->replaceSessions(
            $this->userBO->getUserPseudo(),
            $request->get('sessions')
        );
        return $this->json(true);
    }
}
