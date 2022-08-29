<?php
declare(strict_types=1);

namespace App\Services\Sessions;

class SessionsBO
{
    private SessionsDAO $sessionsDAO;

    public function __construct(SessionsDAO $sessionsDAO)
    {
        $this->sessionsDAO = $sessionsDAO;
    }

    public function getSessions(string $userPseudo): array
    {
        return $this->sessionsDAO->get($userPseudo);
    }

    public function saveSessions(string $userPseudo, array $sessions): void
    {
        $this->sessionsDAO->replaceWith($userPseudo, $sessions);
    }
}
