<?php

declare(strict_types = 1);

namespace App\Controller\Session\Settings;

use App\Controller\Core\GenericController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SettingsController extends GenericController
{
    protected const MENU_CODE = 'sessionSettings';
    /**
     * @Route("/session/settings", name="session_settings_display")
     */
    public function display(): Response
    {
        return $this->getRenderResponse('sessionSettingsPage');
    }
}