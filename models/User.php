<?php

class User extends AbstractModel
{
    protected int $id;
    protected ?string $name;
    protected ?string $email;

    protected static function getTable(): string
    {
        return 'users';
    }

    protected static function getFields(): array
    {
        return ['id', 'name', 'email'];
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
}
