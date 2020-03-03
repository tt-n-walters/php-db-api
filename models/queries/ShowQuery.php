<?php

class ShowQuery extends ReturningQuery {

    private $shown;
    private $location;

    public function __construct(string $shown, string $location) {
        $this->shown = $shown;
        $this->location = $location;
    }

    public function getQueryString(): string {
        return "SHOW $this->shown IN `$this->location`";
    }

}
