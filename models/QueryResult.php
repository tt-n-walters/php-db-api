<?php

class QueryResult {

    public function __construct(Query $query, mysqli_result $result) {

        if ($query instanceof ReturningQuery) {

        } else {

        }
    }
}
