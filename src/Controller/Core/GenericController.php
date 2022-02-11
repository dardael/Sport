<?php

declare(strict_types = 1);

namespace App\Controller\Core;

use App\Services\Account\AccountBO;
use App\Services\Core\User\UserBO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenericController extends AbstractController
{
    protected const IS_USER_NEEDED = true;

    protected const MENU_CODE = '';

    protected UserBO $userBO;

    public function __construct(UserBO $userBO)
    {
        $this->userBO = $userBO;
        if (static::IS_USER_NEEDED) {
            $userBO->authenticate();
        }
    }

    protected function getRenderResponse(string $file, array $variables = []): Response
    {
        if (static::IS_USER_NEEDED) {
            $variables['pseudo'] = $this->userBO->getUserPseudo();
        }
        if (!empty(static::MENU_CODE)) {
            $variables['selectedHomeLinkKey'] = static::MENU_CODE;
        }
        return $this->render(
            'base/base.html.twig',
            [
                'files' => [$file],
                'variables' => $variables,
            ]
        );
    }
}
