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

    private static function getModelByData(array $data): ?static
    {
        $model = new static();
        foreach (static::getFields() as $field) {
            if (isset($data[$field])) {
                $model->$field = $data[$field];
            }
        }

        return $model;
    }
}
