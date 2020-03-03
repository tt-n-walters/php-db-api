<?php

class ColumnsQuery extends ShowQuery {

    public function __construct(Table $table) {
        parent::__construct("COLUMNS", $table->getName());
    }
}
