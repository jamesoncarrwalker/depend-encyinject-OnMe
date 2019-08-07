<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 23/07/2019
 * Time: 14:26
 */

namespace model\authenticators;

use abstractClasses\AbstractDBO;
use constants\AbstractLaundryCycle;
use constants\AbstractPersistenceKeys;
use constants\AbstractTokenTypes;
use interfaces\AuthenticatorInterface;
use interfaces\LoginResponseInterface;
use interfaces\PostmanInterface;
use model\helpers\WashingMachine;

class AuthenticatorWeb implements AuthenticatorInterface, PostmanInterface {

    private $postData;
    private $washingMachine;

    private $username;
    private $password;
    private $sessionPersists;
    private $cookiePersists;

    protected $conn;
    public $loginResponse;

    public function __construct(AbstractDBO $conn, LoginResponseInterface $loginResponse) {
        $this->conn = $conn;
        $this->loginResponse = $loginResponse;
    }

    public function checkPost() {
        if(count($_POST) > 0) $this->setPost();
    }

    public function setPost() {
        $this->washingMachine = new WashingMachine(AbstractLaundryCycle::POST,$_POST);
        $this->postData = $this->washingMachine->getLaundry();
    }

    public function setAuthenticationParams() {
        $this->username = $this->postData->username ?? null;
        $this->password = $this->postData->password ?? null;
        $this->sessionPersists = $this->areLoggedInSessionsSet();
        $this->cookiePersists = $this->areLoggedInCookiesSet();
    }

    public function checkRequiredParamsSet() : bool {
        //nothing is specifically required here
    }

    public function authenticate() {
        $this->checkPost();
        $this->setPost();
        $this->setAuthenticationParams();
        if($this->sessionPersists) $this->setSessionLoginResponse();
        else if ($this->cookiePersists) $this->setCookieLoginResponse();
        else if (isset($this->username,$this->password)) $this->setCredentialsLoginResponse();
    }

    private function areLoggedInSessionsSet() : bool {
        return isset(   $_SESSION[AbstractPersistenceKeys::SESSION_USER_ID],$_SESSION[AbstractPersistenceKeys::SESSION_LOGGED_IN],$_SESSION[AbstractPersistenceKeys::SESSION_LAST_ACTIVE])
                    &&  $_SESSION[AbstractPersistenceKeys::SESSION_LAST_ACTIVE] > time() + (60*60*10);
    }

    private function areLoggedInCookiesSet() : bool {
        return isset($_COOKIE[AbstractPersistenceKeys::COOKIE_SLI],$_COOKIE[AbstractPersistenceKeys::COOKIE_USER_ID]);
    }

    private function setCookieLoginResponse() {
        $tokenAuthenticator = new AuthenticatorToken($this->conn,$_COOKIE[AbstractPersistenceKeys::COOKIE_SLI],AbstractTokenTypes::COOKIE);
    }

    private function setSessionLoginResponse() {

    }

    private function setCredentialsLoginResponse() {

    }


    public function getAuthenticationResponse() {
        // TODO: Implement getAuthenticationResponse() method.
    }
}