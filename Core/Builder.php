<?php

namespace App\Core;

class Builder
{
    public $data;
    public string $table;
    public string $className;

    public function __construct(string $className, $data = [])
    {
        $this->data = $data;
        $this->table = $className::$table;
        $this->className = $className;
    }

    private function handleWhere(string $query, array $values)
    {
        if (isset($this->data["whereConditions"])) {
            $whereConditions = $this->data["whereConditions"];
            $query .= "WHERE ";

            foreach ($whereConditions as $condtion) {

                if (is_string($condtion[2])) {
                    $number = mt_rand(9999, 999999999999999);
                    $values[':' . $number] = $condtion[2];
                    $condtion[2] = ":" . $number;
                }

                $str_condition = join(" ", $condtion);
                $query .= $str_condition;
                $query .= " ";
            }
        }

        return [$query, $values];
    }

    private function handleSelect()
    {
        $query = "";

        if (isset($this->data["scopeElements"])) {
            $query .= join(",", $this->data["scopeElements"]);
        } else {
            $query .= "*";
        }

        $query .= " FROM {$this->table} ";

        return $query;
    }

    private function handleSort(string $query)
    {
        if (isset($this->data["sort"])) {
            $sorting_rules = $this->data["sort"];
            foreach ($sorting_rules as $sorting_rule) {
                $query .= ("ORDER BY " . join(" ", $sorting_rule) . " , ");
            }
            $query = substr($query, 0, strlen($query) - 3);
        }
        return $query;
    }

    private function handleLimit(string $query)
    {
        if (isset($this->data["limit"])) {
            $query .= " LIMIT {$this->data['limit']} ";
        }
        return $query;
    }

    private function build()
    {
        $query = "SELECT ";
        $values = [];

        $query .= $this->handleSelect();

        [$query, $values] = $this->handleWhere($query, $values);

        $query = $this->handleSort($query);

        $query = $this->handleLimit($query);

        $objects = Database::query($query, $values);

        if (!empty($objects)) {
            foreach ($objects as $object) {
                $results[] = new $this->className($object);
            }

            return $results;
        } else {
            return null;
        }
    }

    public function limit(int $limit)
    {
        $this->data["limit"] = $limit;
        return $this;
    }

    public function sort($by)
    {
        $this->data["sort"] = $by;
        return $this;
    }

    public function get()
    {
        return $this->build();
    }

    public function first()
    {
        $obj = $this->build();

        if (!is_null($obj)) {
            return $obj[0];
        }

        return $obj;
    }

    public function delete()
    {
        try {
            $values = [];
            $query = "DELETE FROM {$this->table} ";

            [$query, $values] = $this->handleWhere($query, $values);

            Database::query($query, $values);

            return true;
        } catch (\Exception $err) {
            return false;
        }
    }

    public function update(array $data)
    {

        $query = "UPDATE {$this->table} SET ";

        foreach ($data as $key => $value) {
            $query .= "{$key} = :{$key},";
        }

        $query = substr($query, 0, strlen($query) - 1) . "  ";

        $values = [];

        foreach ($data as $key => $value) {
            $values[":" . $key] = $value;
        }

        [$query, $values] = $this->handleWhere($query, $values);

        try {
            Database::query($query, $values);
            return true;
        } catch (\Exception $err) {
            echo $err->getMessage();
            return false;
        }
    }


    public function create()
    {
        $data = $this->data["insertData"];
        $keys = array_keys($data);
        $data1 = [];

        $imploded_key = implode(',', $keys);

        $query = "INSERT INTO {$this->table}({$imploded_key}) ";

        foreach ($data as $key => $value) {
            $data1[":" . $key]  = $value;
        }

        $keys = array_keys($data1);

        $imploded_keys = implode(',', $keys);

        $query .= "VALUES({$imploded_keys})";

        echo "<pre>";
        var_dump($query);
        echo "</pre>";

        try {
            Database::query($query, $data1);
            return true;
        } catch (\Exception $err) {
            return false;
        }
    }
}
