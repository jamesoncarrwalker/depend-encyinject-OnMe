<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 24/07/2019
 * Time: 13:25
 */

namespace model\authenticators;

use abstractClasses\AbstractDatabaseConnection;
use abstractClasses\AbstractDBO;
use constants\AbstractPersistenceKeys;
use interfaces\AuthenticatorInterface;

class AuthenticatorToken implements AuthenticatorInterface {

    private $token;
    private $userId;
    private $type;
    private $conn;


    public function __construct(AbstractDBO $conn, string $token, string $type) {
        $this->type = $type;
        $this->token = $token;
        $this->conn = $conn;
    }

    public function setAuthenticationParams() {
        switch($this->type) {
            default://cookie
                $this->userId = $_COOKIE[AbstractPersistenceKeys::COOKIE_USER_ID] ?? null;
                break;
        }
    }

    public function checkRequiredParamsSet() : bool {
        return isset($this->userId,$this->token);
    }

    public function authenticate() {
        // TODO: Implement authenticate() method.
    }

    public function getAuthenticationResponse() {
        // TODO: Implement getAuthenticationResponse() method.
    }
}