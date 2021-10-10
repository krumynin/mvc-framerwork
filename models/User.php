<?php

class User extends AbstractModel
{
    protected int $id;
    protected ?string $name;
    protected ?string $email;

    protected ?string $login;
    protected ?string $password;

    protected static function getTable(): string
    {
        return 'users';
    }

    protected static function getFields(): array
    {
        return ['id', 'name', 'email', 'login', 'password'];
    }

    public static function getByLogin(string $login): ?User
    {
        $connection = Db::getConnection();

        $table = self::getTable();
        $sql = "SELECT * FROM {$table} WHERE login = :login";

        $result = $connection->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $result->execute();
        $data = $result->fetch();

        if ($data === false) {
            return null;
        }

        return self::getModelByData($data);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): void
    {
        $this->login = $login;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }
}
