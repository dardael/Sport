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

    protected function update(array $filter, array $data): void
    {
        $this->getCollection()->updateMany($filter, ['$set' => $data]);
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

    protected function findOneWithFields(
        array $filter,
        array $fields
    ): ?array {
        $projection = array_merge(array_fill_keys($fields, 1), ['_id' => 0]);
        return $this->getCollection()->findOne($filter, ['projection' => $projection]);
    }

    private function getDatabase(): MongoDB\Database
    {
        $options = ["typeMap" => ['root' => 'array', 'document' => 'array']];
        $client = new MongoDB\Client(
            "mongodb://dardael:aty30ITE@mongodb:27017",
            [],
            $options
        );
        return $client->sport;
    }
}
