<?php

class Table {

    private $name;
    private $columns;
    private $database;

    public function __construct(string $name, Database $database = null) {
        $this->name = $name;
        $this->columns = array();
        $this->database = $database;
    }

    private function assertDatabase() {
        if ($this->database == null) {
            exit("Table '$this->name' is not a member of the database.");
        }
    }

    private function pullColumnNames(): void {

    }

    public function getColumnNames(): array {

    }

    public function getColumn($name): ?Column {

    }

    public function addColumn($column): void {

    }

    public function getName(): string {
        return $this->name;
    }
}
