<?php
declare(strict_types = 1);
namespace App\Services\Core\Database;

use MongoDB;

abstract class DAO
{
    protected const COLLECTION = '';

    protected function insert(array $data): void
    {
        $this->getCollection()->insertOne($data);
    }

    protected function exists(array $filter): bool
    {
        $collection = $this->getCollection();
        return !empty($collection->findOne($filter));
    }

    protected function getCollection(): MongoDB\Collection
    {
        return $this->getDatabase()->{static::COLLECTION};
    }

    private function getDatabase(): MongoDB\Database
    {
        $client = new MongoDB\Client("mongodb://dardael:aty30ITE@mongodb:27017");
        return $client->sport;
    }
}
