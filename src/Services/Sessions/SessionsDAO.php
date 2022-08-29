<?php
declare(strict_types=1);

namespace App\Services\Sessions;

use App\Services\Core\Database\DAO;

class SessionsDAO extends DAO
{
    protected const COLLECTION = 'accounts';

    public function get(string $userPseudo): array
    {
        $sessions = $this->findOneWithFields(
            ['pseudo' => $userPseudo, 'isCertified' => true],
            ['sessions']
        )['sessions'] ?? [];
        return array_values(array_map(
            fn($session) => new SessionDTO(
                (int) $session['id'],
                (float) $session['value'],
                (int) $session['sessionTypeId'],
                (string) $session['date']
            ),
            $sessions
        ));
    }

    public function replaceWith(string $userPseudo, array $sessions): void
    {
        $this->update(
            ['pseudo' => $userPseudo],
            ['sessions' => $sessions]
        );
    }
}
