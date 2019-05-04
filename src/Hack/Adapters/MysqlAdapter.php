<?php

namespace Core\Hack\Adapters;

use Core\Hack\Interfaces\Builder;
use PDO;

class MysqlAdapter implements Builder
{
    protected $table;
    protected $query;
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function setTable(string $table)
    {
        if (!isset($this->table)) {
            $this->table = $table;
        }
    }

    public function select($columns = '*', array $data = [])
    {
        $query = "SELECT {$columns} FROM {$this->table}";

        if (!isset($data)) {
            $query .= " WHERE " . $this->params($data);
        }

        $this->query = $this->pdo->prepare($query);

        $this->bind($data);

        return $this;
    }

    public function all()
    {
        return $this->query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function first()
    {
        return $this->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {   
        $places = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $query = "INSERT INTO {$this->table}({$places}) VALUES({$values})";

        $this->query = $this->pdo->prepare($query);

        $this->bind($data);

        return $this;
    }

    public function update($id, array $data)
    {   
        $places = $this->params($data);

        $query = "UPDATE {$this->table} SET {$places} WHERE product_id = :product_id";

        $this->query = $this->pdo->prepare($query);

        $this->bind($data);
        $this->query->bindValue(':product_id', $id);

        return $this;
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM {$this->table} WHERE product_id = :product_id";

        $this->query = $this->pdo->prepare($query);

        $this->query->bindValue('product_id', $id);

        return $this;

    }

    public function bind($params)
    {   
        foreach ($params as $key => $value) {
            $this->query->bindValue($key, $value);
        }
    }

    public function params($params)
    {
        $parameters = [];
        foreach ($params as $key => $value) {
            $parameters[] = $key .' = :'. $key;
        }

        return implode(', ', $parameters);
    }

    public function exec($query = null)
    {
        if ($query) {
            $this->query->prepare($query);
        }

        $this->query->execute();
        return $this;
    }
}
