<?php
declare(strict_types = 1);
namespace App\Services\Account;

use MongoDB;

class Account
{
    public function create(string $mail, string $pseudo, string $password): void
    {
        $client = new MongoDB\Client("mongodb://dardael:aty30ITE@localhost:27017");
        $collection = $client->demo->beers;
        $result = $collection->insertOne( [ 'name' => 'Hinterland', 'brewery' => 'BrewDog' ] );
    }
}