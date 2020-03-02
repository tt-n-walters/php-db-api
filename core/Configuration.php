<?php

class Configuration {

    private $connection = array(
        "host" => null,
        "databaseName" => null,
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

    public static function fromFile(string $filename) {
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
        boolean $select = true,
        boolean $insert = true,
        boolean $update = true,
        boolean $delete = true,
        boolean $create = true,
        boolean $drop = true,
    ) {
        $this->connection["host"] = $host;
        $this->connection["database"] = $database;
        $this->connection["username"] = $username;
        $this->connection["password"] = $password;
        $this->permissions["select"] = $select,
        $this->permissions["insert"] = $insert,
        $this->permissions["update"] = $update,
        $this->permissions["delete"] = $delete,
        $this->permissions["create"] = $create,
        $this->permissions["drop"] = $drop,
    }

    public function saveToFile(string $filename) {
        $connection = array_values($this->connection);
        $permissions = array_values($this->per$permissions);

        file_put_contents($filename, implode("\n", array_merge($connection, $permissions));
    }

    public function getConnectionAll() {
        return $this->connection;
    }

    public function getConnectionHost() {
        return $this->connection["host"];
    }

    public function getConnectionDatabase() {
        return $this->connection["database"];
    }

    public function getConnectionUsername() {
        return $this->connection["username"];
    }

    public function getConnectionPassword() {
        return $this->connection["password"];
    }

    public function getPermissionsAll() {
        return $this->permissions;
    }

    public function getPermission(string $permission) {
        if (array_key_exists($permission, $this->permissions)) {
            return $this->permissions[permission];
        } else {
            
        }
    }
}
