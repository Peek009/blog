<?php

declare(strict_types=1);

use Database\Database;

class Model
{
    //use train for db bc we might need another extension
    use Database;

    public function __construct(string $table, array $errors = [])
    {
        $this->table = $table;
        $this->errors = $errors;
    }

    public function where(array $data)
    {
        $keys = array_keys($data);
        $query = "select * from $this->table where ";

        foreach ($keys as $key ) {
            $query .= $key . ' = :'. $key . ' && ';
        }

        $query = trim($query, '& ');

        return $this->query($query, $data);
    }

    public function insert(array $data): bool
    {
        $keys = array_keys($data);

        $query = "insert into $this->table (".implode(',', $keys).") values (:".implode(',:', $keys).")";
        $this->query($query, $data);

        return false;
    }

    public function update(int $id, array $data, string $id_column = 'id'): bool
    {
        if (isset($this->allowedColumns))
        {
            foreach ($data as $key) {
                if(!in_array($key, $this->allowedColumns))
                {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "update $this->table set ";

        foreach($keys as $key) {
            $query .= $key . ' = :' . $key . ', ';
        }

        $query = trim($query, ', ');

        $query .= " where $id_column = :$id_column";

        $data[$id_column] = $id;

        $this->query($query, $data);

        return false;
    }

    public function delete(int $id, string $id_column = 'id'): bool
    {
        $data[$id_column] = $id;

        $query = "delete from $this->table where $id_column = :$id_column";
        $this->query($query, $data);

        return false;
    }

    public function findAll()
    {
        $query = "select * from $this->table";
        return $this->query($query);
    }

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['name']))
        {
            $this->errors['name'] = 'name is required';
        }

        if (empty($data['textarea']))
        {
            $this->errors['textarea'] = 'text is required';
        }

        return empty($this->errors);
    }
}