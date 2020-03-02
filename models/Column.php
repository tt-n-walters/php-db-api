<?php

class Column {

    private $name;
    private $type;
    private $nullable;
    private $keyType;
    private $default;
    private $extra;

    public static function getKeyString($column): ?string {
        if ($column->keyType == "PRI") {
            return "PRIMARY KEY (`$column->name`)";
        } else if ($column->keyType == "UNI") {

        } else if ($column->keyType == "MUL") {

        } else {
            return null;
        }
    }

    public function __construct(string $name, string $type, string $keyType) {
        $this->name = $name;
        $this->type = $type;
        $this->keyType = $keyType;

        $this->nullable = False;
        $this->default = null;
        $this->extra = null;

        if ($type == "datetime" || $type == "timestamp") {
            $this->default = "DEFAULT CURRENT_TIMESTAMP";
        }

        if ($name == "id" && $type == "int") {
            $this->extra = "AUTO_INCREMENT, PRIMARY KEY (`id`)";
        }
    }

    public function getCreateString(): string {
        return "`$this->name` " . implode(" ", array_filter(array(
            $this->type,
            $this->nullable,
            $this->default,
            $this->extra
        )));
    }

    public function getName(): string {
        return $this->name;
    }

    public function getType(): string {
        return $this->type;
    }
}
