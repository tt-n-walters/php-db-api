<?php

class Table {

    private $name;
    private $database;

    private $columns;

    public function __construct(string $name, Database $database = null) {
        $this->name = $name;
        $this->database = $database;

        $this->columns = array();
    }

    private function assertDatabase() {
        if ($this->database == null) {
            exit("Table '$this->name' is not a member of the database.");
        }
    }

    private function pullColumns(): void {
        $this->assertDatabase();
        $result = $this->database->performQuery(new ColumnsQuery($this));
        foreach ($result as $definition) {
            $name = $definition["Field"];
            $type = preg_replace("/(\d*)/", "", $definition["Type"]);
            $key = $definition["Key"];
            $this->addColumn(new Column($name, $type, $key));
        }
    }

    public function getColumnNames(): array {
        if (count($this->columns) === 0) {
            $this->pullColumns();
        }
        return array_map(function($column) {
            return $column->getName();
        }, $this->columns);
    }

    public function getColumn(string $name): ?Column {
        if (count($this->columns) === 0) {
            $this->pullColumns();
        }
        return array_shift(array_filter($this->columns, function($column) use ($name): bool {
            return $column->getName() == $name;
        }));
    }

    public function addColumn(Column $column): void {
        array_push($this->columns, $column);
    }

    public function setColumns(array $columns): void {
        $this->columns = array();
        foreach ($columns as $column) {
            $this->addColumn($column);
        }
    }

    public function getName(): string {
        return $this->name;
    }
}
