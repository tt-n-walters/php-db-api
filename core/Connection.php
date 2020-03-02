<?php

class Connection {

    private $configuration;
    private $connection;

    public function __construct(Configuration $configuration) {
        $this->configuration = $configuration;

        try {
            $this->connection = new mysqli(
                $configuration->getConnectionHost(),
                $configuration->getConnectionDatabase(),
                $configuration->getConnectionUsername(),
                $configuration->getConnectionPassword(),
            );
        } catch (mysqli_sql_exception $e) {
            exit($e->getMessage());
        }
    }

    public function getDatabase() {
        return new Database($this, $this->configuration->getDatabaseName);
    }

    public function getPermissions() {
        return $this->configuration->getPermissions();
    }

    public function getPermission(string $permission) {
        return $this->configuration->getPermission($permission);
    }

    public function performQuery(BaseQuery $query) {
        $result = $query->execute($this);
        return $result;
    }
}