<?php

abstract class Query {

    public abstract function getQueryString();

    public abstract function handleResult();
}