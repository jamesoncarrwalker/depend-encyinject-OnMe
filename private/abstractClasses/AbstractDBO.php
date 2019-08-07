<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 26/07/2019
 * Time: 12:47
 */

namespace abstractClasses;


use interfaces\QueryConnectionManagerInterface;
use interfaces\QueryPrepareInterface;
use interfaces\QueryResultsInterface;

abstract class AbstractDBO implements QueryPrepareInterface,QueryResultsInterface,QueryConnectionManagerInterface {
    protected $conn;
}