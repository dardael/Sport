<?php

declare(strict_types = 1);

namespace App\Controller\Security;

use Symfony\Component\HttpFoundation\Response;

class Identification
{
    public function display(): Response
    {
       return new Response(
            '<html><body>coucou</body></html>'
        );
    }
}