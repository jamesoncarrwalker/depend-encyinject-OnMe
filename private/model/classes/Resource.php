<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 06/08/2019
 * Time: 20:48
 */

namespace model\classes;


class Resource {

    public $type;
    public $name;
    public $location;

    public function __construct(int $type,string $name, string $location) {
        $this->location = $location;
        $this->name = $name;
        $this->type = $type;
    }
}