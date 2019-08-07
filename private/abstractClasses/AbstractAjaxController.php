<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 17/07/2019
 * Time: 14:04
 */

namespace abstractClasses;

use interfaces\ControllerInterface;

abstract class AbstractAjaxController implements ControllerInterface {


    public function isValidRequest() {
        // TODO: Implement isValidRequest() method.
    }

    public function runRequest() {
        // TODO: Implement runRequest() method.
    }

    public function setResponse($response) {
        // TODO: Implement setResponse() method.
    }

    public function getResponse() {
        // TODO: Implement getResponse() method.
    }

    public function setParams(array $params) {
        // TODO: Implement setParams() method.
    }

    public function setDefaultRequest() {
        // TODO: Implement setDefaultRequest() method.
    }
}