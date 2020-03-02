<?php

class Column {

    private $name;
    private $type;
    private $nullable;
    private $keyType;
    private $default;
    private $extra;

    public static function getKeyString($column): ?string {
        if ($column->keyType !== null) {
            return "PRIMARY KEY (`$column->name`)";
        } else {
            return null;
        }
    }

    public function __construct(string $name, string $type, string $keyType) {

    }

    public function getCreateString(): string {

    }

    public function getName(): string {
        return $this->name;
    }

    public function getType(): string {
        return $this->type;
    }
}
