<?php
declare(strict_types = 1);
namespace App\Services\Core\Database;

use MongoDB;

abstract class DAO
{
    protected const COLLECTION = '';

    protected function insert(array $data):void {
        $this->getCollection()->insertOne($data);
    }

    private function getDatabase()
    {
        $client = new MongoDB\Client("mongodb://dardael:aty30ITE@mongodb:27017");
        return $client->sport;
        $result = $collection->insertOne( [ 'mail' => $mail, 'pseudo' => $pseudo, 'password' => $password, ] );
    }

    private function getCollection()
    {
        return $this->getDatabase()->{static::COLLECTION};
    }
}