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

    public function getName(): string {
        return $this->name;
    }

    private function pullTables(): void {
        $this->tables = array();
        $result = $this->performQuery(new TablesQuery($this));
        foreach ($result as $tableName) {
            $this->addTable(new Table($tableName, $this));
        }
    }

    public function getTableNames(): array {
        if (count($this->tables) === 0) {
            $this->pullTables();
        }
        return array_map(function(Table $table): string {
            return $table->getName();
        }, $this->tables);
    }

    public function getTable(string $name): ?Table {
        if (count($this->tables) === 0) {
            $this->pullTables();
        }
        return array_shift(array_filter($this->tables, function(Table $table) use ($name): bool {
            return $table->getName() == $name;
        }));
    }

    public function addTable(Table $table): void {
        array_push($this->tables, $table);
    }

    public function performQuery(Query $query): QueryResult {
        return $this->connection->performQuery($query);
    }
}
