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

    public function setDebugMode(bool $mode) {
        $this->debugMode = $mode;
    }

    public function setExecuteMode(bool $mode) {
        $this->executeMode = $mode;
    }

    private function pullTableNames() {
        
    }

    public function getTableNames() {

    }

    public function getTable($name) {

    }
}
