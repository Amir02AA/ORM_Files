<?php

namespace query_builder;

use PDO;
use query\SqlConnection;

class SqlQueryBuilder
{
    private PDO $pdo;
    private static ?self $instance = null;
    private string $table;
    private array $data = [];

    private string $query;

    private function __construct()
    {
        $this->pdo = SqlConnection::getConnection();
    }

    public static function getInstance(): self
    {
        return (self::$instance) ?: self::$instance = new self();
    }

    public function table(string $tableName)
    {
        $this->table = $tableName;
        return $this;
    }

    public function select(array $columns = ['*'])
    {
        $columns = implode(",", $columns);
        $this->query = "select $columns from " . $this->table . " ";
        return $this;
    }

    public function insert(array $values)
    {
        $this->data = $values;
        $columns = implode(',', array_keys($values));
        $values = array_map(fn($x) => ":$x", array_keys($values));
        $placeHolders = implode(',', $values);

        $this->query = "insert into " . $this->table . "($columns)"
            . " values($placeHolders)";

        return $this;
    }

    public function where(string $column, string $value, $operation = '=')
    {
        $this->data[$column] = $value;
        $this->query .= " where $column $operation :$column";
        return $this;
    }

    public function update(array $values)
    {
        $this->data = $values;
        $columns = array_keys($values);

        $this->query = "update " . $this->table . " set ";
        foreach ($columns as $key => $column) {
            $this->query .= "$column=:$column";
            $this->query .= ($key == sizeof($columns) - 1)? "" : ", ";
        }
        return $this;
    }

    public function exec()
    {
        $this->pdo->prepare($this->query)->execute($this->data);
        $this->reset();
    }

    public function fetchAll()
    {
        $stmnt = $this->pdo->prepare($this->query);
        $stmnt->execute($this->data);
        $results = $stmnt->fetchAll();

        $this->reset();
        return $results;
    }

    public function reset()
    {
        $this->data = [];
        $this->query = '';
        $this->table = '';
    }

    public function setFetchMethodObject()
    {
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    }

    public function setFetchMethodArray()
    {
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    }
}