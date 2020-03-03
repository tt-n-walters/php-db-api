<?php

class Configuration {

    private $connection = array(
        "host" => null,
        "database" => null,
        "username" => null,
        "password" => null
    );

    private $permissions = array(
        "select" => true,
        "insert" => true,
        "update" => true,
        "delete" => true,
        "create" => true,
        "drop" => true
    );

    public static function fromFile(string $filename): Configuration {
        if (file_exists($filename)) {
            $file = file($filename, FILE_IGNORE_NEW_LINES) or exit("Unable to open credentials file.");

            return new Configuration(...$file);
        }
    }

    public function __construct(
        string $host,
        string $database,
        string $username,
        string $password,
        bool $select = true,
        bool $insert = true,
        bool $update = true,
        bool $delete = true,
        bool $create = true,
        bool $drop = true
    ) {
        $this->connection["host"] = $host;
        $this->connection["database"] = $database;
        $this->connection["username"] = $username;
        $this->connection["password"] = $password;
        $this->permissions["select"] = $select;
        $this->permissions["insert"] = $insert;
        $this->permissions["update"] = $update;
        $this->permissions["delete"] = $delete;
        $this->permissions["create"] = $create;
        $this->permissions["drop"] = $drop;
    }

    public function saveToFile(string $filename): void {
        $connection = array_values($this->connection);
        $permissions = array_values($this->permissions);

        file_put_contents($filename, implode("\n", array_merge($connection, $permissions)));
    }

    public function getConnectionAll(): array {
        return $this->connection;
    }

    public function getConnectionHost(): string {
        return $this->connection["host"];
    }

    public function getConnectionDatabase(): string {
        return $this->connection["database"];
    }

    public function getConnectionUsername(): string {
        return $this->connection["username"];
    }

    public function getConnectionPassword(): string {
        return $this->connection["password"];
    }

    public function getPermissionsAll(): array {
        return $this->permissions;
    }

    public function getPermission(string $permission): ?string {
        if (array_key_exists($permission, $this->permissions)) {
            return $this->permissions[$permission];
        } else {
            return null;
        }
    }
}
