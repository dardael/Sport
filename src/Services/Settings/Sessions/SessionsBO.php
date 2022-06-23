<?php
declare(strict_types=1);

namespace App\Services\Settings\Sessions;

class SessionsBO
{
    private SessionsDAO $sessionsDAO;

    public function __construct(SessionsDAO $sessionsDAO)
    {
        $this->sessionsDAO = $sessionsDAO;
    }

    public function replaceSessions(string $userPseudo, array $sessions): void
    {
        $this->sessionsDAO->replaceWith($userPseudo, $sessions);

    }

    public function getSessions(string $userPseudo): array
    {
        return $this->sessionsDAO->get($userPseudo);
    }
}
