<?php

namespace app\database\model;

use app\database\Connection;

abstract class Model
{
    protected string $table;

    public function find(string $field, mixed $value)
    {
        $connection = Connection::get();
        $prepare = $connection->prepare("select * from {$this->table} where {$field} = :{$field}");
        $prepare->execute([$field => $value]);

        return $prepare->fetchObject(static::class);
    }

    public function update(array $attributes)
    {
        $connection = Connection::get();
        $sql = "update {$this->table} set";
        // $prepare = $connection->prepare();
    }
}
