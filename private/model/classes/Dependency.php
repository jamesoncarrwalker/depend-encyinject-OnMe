<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 25/07/2019
 * Time: 13:08
 */

namespace model\classes;


class Dependency {
    public $type;
    public $name;
    public $value;

    public function __construct(int $type,$value,string $name = null) {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
    }
}