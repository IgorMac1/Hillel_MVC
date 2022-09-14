<?php

namespace Core\Traits\Db;

use Core\Db;
use PDO;

trait Queryable
{
    static public string|null $tableName = '';

    static protected string $query = '';

    static protected array $bindParams = [];

    static public array $fillable = [];

    public static function all()
    {
        self::$query = "SELECT * FROM " . static::$tableName;

        return self::executeGetQuery(self::$query, [], false);
    }

    public static function select()
    {
        static::$query = "SELECT * FROM " . static::$tableName . " WHERE 1=1";
        return new static();
    }

    public function where(string $column, string $operator, string $value, string $condition = 'AND')
    {
        static::$query .= ' ' . $condition . ' ' . $column . ' ' . $operator . ' :' . $column;
        static::$bindParams[$column] = $value;

        return $this;
    }

    public function get()
    {
        $query = Db::connect()->prepare(static::$query);
        $query->execute(static::$bindParams);

        return $query->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public static function find(int $id)
    {
        self::$query = "SELECT * FROM " . static::$tableName . " WHERE id = :id";
        static::$bindParams = [
            'id' => $id
        ];

        return self::executeGetQuery(self::$query, static::$bindParams);
    }

    public static function findBy(string $column, $value)
    {
        self::$query = "SELECT * FROM " . static::$tableName . " WHERE {$column} = :{$column}";

        self::$bindParams = [];
        self::$bindParams[$column] = $value;
        return self::executeGetQuery(self::$query, static::$bindParams);
    }

    public static function create(array $fields)
    {
        $insertFields = [];
        $insertPlaceholders = [];
        self::$bindParams = [];
        foreach ($fields as $key => $field) {
            if (in_array($key, static::$fillable)) {
                $insertFields[] = $key;
                $insertPlaceholders[] = ':' . $key;
                self::$bindParams[$key] = $field;
            }
        }

        self::$query = "INSERT INTO " . static::$tableName . " ( " . implode(',', $insertFields) . " ) VALUES ( " . implode(',', $insertPlaceholders) . ")";

        $insertId = self::executeSetQuery(self::$query, static::$bindParams);

        return self::find($insertId);
    }

    public function update(array $fields)
    {
        $updateFields = [];
        $bindParams = [];

        foreach ($fields as $key => $field) {
            if (in_array($key, static::$fillable)) {
                $updateFields[] = $key . ' = ' . ':' . $key;
                $bindParams[$key] = $field;
            }
        }
        $bindParams['id'] = $this->id;
        $query = "UPDATE " . static::$tableName . " SET " . implode(',', $updateFields) . " WHERE id = :id";

        $query = self::prepareQuery($query, $bindParams);
        $query->execute($bindParams);

        return self::find($this->id);
    }

    public static function delete(int $id)
    {
        $bindParams['id'] = $id;
        $query = "DELETE FROM " . static::$tableName . " WHERE id = :id";

        $query = self::prepareQuery($query, $bindParams);
        $query->execute($bindParams);

        return true;
    }

    private static function executeGetQuery(string $query, array $bindParams, $getSingleObject = true)
    {
        try {
            $query = self::prepareQuery($query, $bindParams);
            $query->execute($bindParams);

            if ($getSingleObject) {
                return $query->fetchObject(static::class);
            } else {
                return $query->fetchAll(PDO::FETCH_CLASS, static::class);
            }
        } catch (\Exception $exception) {
            return null;
        }
    }

    private static function executeSetQuery(string $query, array $bindParams)
    {
        try {
            $query = self::prepareQuery($query, $bindParams);
            $query->execute($bindParams);

            return Db::connect()->lastInsertId();
        } catch (\Exception $exception) {
            return null;
        }
    }

    private static function prepareQuery(string $query, array $bindParams)
    {
        return Db::connect()->prepare($query);
    }

}