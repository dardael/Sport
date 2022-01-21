<?php
declare(strict_types = 1);
namespace App\Services\Account;

use MongoDB;

class Account
{
    public function create(string $mail, string $pseudo, string $password): void
    {
        $client = new MongoDB\Client("mongodb://dardael:aty30ITE@mongodb:27017");
        $collection = $client->sport->accounts;
        $result = $collection->insertOne( [ 'mail' => $mail, 'pseudo' => $pseudo, 'password' => $password, ] );
    }
}