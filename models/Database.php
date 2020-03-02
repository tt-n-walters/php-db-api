<?php

class Database {

    private $connection;
    private $name;
    private $tables;

    private $debugMode = true;
    private $executeMode = false;

    public function __construct(Connection $connection, string $name) {
        $this->connection = $connection;
        $this->name = $name;

        $this->tables = array();
    }

    public function setDebugMode(bool $mode): void {
        $this->debugMode = $mode;
    }

    public function setExecuteMode(bool $mode): void {
        $this->executeMode = $mode;
    }

    private function pullTableNames(): void {
        $result = new ShowQuery($this, "tables");
    }

    public function getTableNames(): array {

    }

    public function getTable($name): ?Table {

    }
}
