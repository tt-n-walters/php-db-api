<?php

class Connection {

    private $configuration;
    private $mysqli;

    public function __construct(Configuration $configuration) {
        $this->configuration = $configuration;

        try {
            $this->mysqli = new mysqli(
                $configuration->getConnectionHost(),
                $configuration->getConnectionDatabase(),
                $configuration->getConnectionUsername(),
                $configuration->getConnectionPassword(),
            );
        } catch (mysqli_sql_exception $e) {
            exit($e->getMessage());
        }
    }

    public function getDatabase(): Database {
        return new Database($this, $this->configuration->getDatabaseName);
    }

    public function getPermissions(): array {
        return $this->configuration->getPermissionsAll();
    }

    public function getPermission(string $permission): ?bool {
        return $this->configuration->getPermission($permission);
    }

    public function performQuery(Query $query): QueryResult {
        $result = $this->mysqli->query($query->getQueryString());
        return new QueryResult($query, $result);
    }
}
