<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/08/2019
 * Time: 21:37
 */

namespace abstractClasses;


use constants\AbstractResourceTypes;
use interfaces\ResourcesInterface;

abstract class AbstractPublicPage extends AbstractPage implements ResourcesInterface{

    public function __construct() {
        $this->addResource(AbstractResourceTypes::CSS,'mainPublicStyle','style.css');
    }

    public function setTemplate() {
        // TODO: Implement setTemplate() method.
    }

    public function setBody() {
        // TODO: Implement setBody() method.
    }

    public function addResource(string $type, string $name, string $location, array $params = []) {
        if($type == AbstractResourceTypes::CSS) $this->css[$name] = '<link href="private/css/'.  $location . '" rel="stylesheet"/>';
        else if ($type == AbstractResourceTypes::JS)$this->js[$name] = '<script src="'.  $location . '" type="text/javascript"></script>';
    }

    public function removeResource(string $type, string $name) {
        if($type == AbstractResourceTypes::CSS) unset($this->css[$name]);
        else if ($type == AbstractResourceTypes::JS) unset($this->js[$name]);
    }

    public function getResource(string $type, string $name) {
        // TODO: Implement getResource() method.
    }
}