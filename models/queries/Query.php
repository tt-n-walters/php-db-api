<?php

abstract class Query {

    public abstract function getQueryString(): string;

    public abstract function handleResult(): ?string;
}