<?php

class TablesQuery extends ShowQuery {

    public function __construct(Database $database) {
        parent::__construct("TABLES", $database->getName());
    }
}
