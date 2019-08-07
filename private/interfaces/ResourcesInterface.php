<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/08/2019
 * Time: 22:22
 */

namespace interfaces;


interface ResourcesInterface {

    public function addResource(string $type,string $name,string $location,array $params);

    public function removeResource(string $type,string $name);

    public function getResource(string $type,string $name);
}