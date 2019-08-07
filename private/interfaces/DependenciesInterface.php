<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 25/07/2019
 * Time: 13:39
 */

namespace interfaces;


interface DependenciesInterface {

    public function hasDependencies(string $name,string $type) : bool;

    public function setDependencies();

    public function getDependencies(string $name,string $type);
}