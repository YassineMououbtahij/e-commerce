<?php

namespace App\Core;

use App\Core\Builder;

class Model
{
    public static string $table;

    public static function create(array $data)
    {
        return (new Builder(static::class, ["insertData" => $data]))->create();
    }

    public function __construct($informations)
    {
        foreach ($informations as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function update(int $id, array $data)
    {
        return static::where([["id", "=", $id]])->update($data);
    }

    public static function delete(int $id)
    {
        return static::where([["id", "=", $id]])->delete();
    }

    public static function where(array $whereConditions)
    {
        return new Builder(static::class, [
            "whereConditions" => $whereConditions
        ]);
    }

    public static function limit(int $limit)
    {
        return (new Builder(static::class))->limit($limit)->get();
    }

    public static function find(int $id)
    {
        return (new Builder(static::class, [
            "whereConditions" => [
                ["id", "=", $id]
            ]
        ]))->first();
    }

    public static function select(array $scopeElements)
    {
        return new Builder(static::class, [
            "scopeElements" => $scopeElements
        ]);
    }

    public static function sort(array $sortingConditions)
    {
        return new Builder(static::class, [
            "sort" => $sortingConditions
        ]);
    }

    public static function all()
    {
        return (new Builder(static::class, []))->get();
    }
}
