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

    protected UserBO $userBO;

    public function __construct(UserBO $userBO)
    {
        $this->userBO = $userBO;
        if (self::IS_USER_NEEDED) {
            $userBO->authenticate();
        }
    }

    protected function getRenderResponse(string $file, array $variables = []): Response
    {
        return $this->render(
            'base/base.html.twig',
            [
                'files' => [$file],
                'variables' => $variables,
            ]
        );
    }
}
