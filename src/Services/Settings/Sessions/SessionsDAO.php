<?php
declare(strict_types=1);

namespace App\Services\Settings\Sessions;

use App\Services\Core\Database\DAO;

class SessionsDAO extends DAO
{
    protected const COLLECTION = 'accounts';

    public function get(string $userPseudo): array
    {
        $settings = $this->findOneWithFields(
            ['pseudo' => $userPseudo, 'isCertified' => true],
            ['settings.sessions']
        )['settings'] ?? [];
        return array_values(array_map(
            fn($session) => new SessionDTO(
                (int) $session['id'],
                $session['exercice'],
                Unit::from($session['unit']),
                $session['description']
            ),
            $settings['sessions'] ?? []
        ));
    }

    public function replaceWith(string $userPseudo, array $sessionSettings): void
    {
        $this->update(
            ['pseudo' => $userPseudo],
            ['settings.sessions' => $sessionSettings]
        );
    }
}
