<?php
declare(strict_types = 1);
// src/Controller/Security/IdentificationController.php
namespace App\Controller\Security;

use App\Controller\Core\GenericController;
use App\Services\Account\AccountBO;
use App\Services\Core\User\UserBO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class IdentificationController extends GenericController
{
    protected const IS_USER_NEEDED = false;

    private SessionInterface $session;

    public function __construct(UserBO $userBO, RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
        parent::__construct($userBO);
    }
    /**
     * @Route("/", name="identification")
     */
    public function display(Request $request): Response
    {
        return $this->getRenderResponse(
            'authenticatePage',
            [
                'isFromCreation' => $request->query->has('isFromCreation'),
                'isFromInvalidCertification'
                    => $request->query->has('isFromInvalidCertification'),
                'isFromValidCertification'
                    => $request->query->has('isFromValidCertification'),
                'isFromForgottenEmail'
                    => $request->query->has('isFromForgottenEmail'),
                'isFromInvalidConnection'
                    => $request->query->has('isFromInvalidConnection'),
            ]
        );
    }

    /**
     * @Route("/isConnectionValid", name="isConnectionValid")
     */
    public function isConnectionValid(Request $request, AccountBO $accountBO): Response
    {
        $isConnectionValid = $accountBO->isConnectionValid(
            $request->get('email'),
            $request->get('password')
        );
        return $this->json($isConnectionValid);
    }

    /**
     * @Route("/connect", name="connect")
     */
    public function connect(Request $request): Response
    {
        try {
            $this->userBO->connect($request->get('email'), $request->get('password'));
        } catch (\Exception $exception) {
            return $this->redirectToRoute(
                'identification',
                ['isFromInvalidConnection' => true]
            );
        }
        return $this->redirectToRoute('home_display');
    }
}
