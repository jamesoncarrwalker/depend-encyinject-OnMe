<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 23/07/2019
 * Time: 14:30
 */

namespace controller;

use abstractClasses\AbstractDBO;
use interfaces\AuthenticatorInterface;
use interfaces\ControllerInterface;
use interfaces\LoginResponseInterface;

class Login implements ControllerInterface {

    private $authenticator;
    private $conn;
    public $loginResponse;
    public $userAuthenticated;


    public function __construct(AbstractDBO $conn, AuthenticatorInterface $authenticatorInterface) {
        $this->authenticator = $authenticatorInterface;
        $this->conn = $conn;
        echo 'let\'s log in!';
    }

    public function doLogin() : LoginResponseInterface {

    }

    private function loginSetup() {

    }

    public function isValidRequest() {
        // TODO: Implement isValidRequest() method.
    }

    public function runRequest() {
        // TODO: Implement runRequest() method.
    }

    public function setResponse() {
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

    public function getDefaultRequest() {
        // TODO: Implement getDefaultRequest() method.
    }

    public function setPage() {
        // TODO: Implement setPage() method.
    }
}