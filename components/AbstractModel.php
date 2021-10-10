<?php

abstract class AbstractModel
{
    abstract protected static function getTable(): string;
    abstract protected static function getFields(): array;

    public static function getById(int $id): ?static
    {
        $connection = Db::getConnection();

        $table = static::getTable();
        $sql = "SELECT * FROM {$table} WHERE id = :id";

        $result = $connection->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $result->execute();
        $data = $result->fetch();

        if ($data === false) {
            return null;
        }

        return self::getModelByData($data);
    }

    public static function getAll(): array
    {
        $connection = Db::getConnection();

        $table = static::getTable();
        $sql = "SELECT * FROM {$table}";

        $result = $connection->prepare($sql);

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $result->execute();
        $data = $result->fetchAll();

        $models = [];
        foreach ($data as $modelData) {
            $models[] = self::getModelByData($modelData);
        }

        return $models;
    }

    public static function getModelByData(array $data): ?static
    {
        $model = new static();
        foreach (static::getFields() as $field) {
            if (isset($data[$field])) {
                $model->$field = $data[$field];
            }
        }

        return $model;
    }

    public function save(): void
    {
        $fields = [];
        $data = [];
        foreach (static::getFields() as $field) {
            if (isset($this->$field)) {
                $fields[] = $field;
                $data[] = $this->$field;
            }
        }

        $queryFields = implode(',', $fields);

        $rangePlace = array_fill(0, count($fields), '?');
        $queryData = implode(',', $rangePlace);

        $connection = Db::getConnection();
        $table = static::getTable();
        try {
            $stmt = $connection->prepare("INSERT INTO $table ($queryFields) values ($queryData)");
            $stmt->execute($data);
        } catch(PDOException $e) {
            echo 'Error : ' . $e->getMessage();
            echo '<br/>Error sql : ' . "'INSERT INTO $table ($queryFields) values ($queryData)'";
            exit();
        }
    }
}
