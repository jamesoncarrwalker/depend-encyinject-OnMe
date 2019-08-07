<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 25/07/2019
 * Time: 22:14
 */

namespace model\helpers;

use abstractClasses\AbstractDBO;
use constants\AbstractPersistenceKeys;
use constants\AbstractTokenTypes;
use interfaces\AuthenticatorInterface;
use model\authenticators\AuthenticatorApi;
use model\authenticators\AuthenticatorToken;
use model\authenticators\AuthenticatorWeb;
use model\responseObjects\LoginResponseApi;
use model\responseObjects\LoginResponseWeb;

class GetAuthenticator {

    public static function getLoginAuthenticator(AbstractDBO $conn) : AuthenticatorInterface {
        if(isset($_REQUEST['api'])) return new AuthenticatorApi($conn, new LoginResponseApi());
        if(!isset($_SESSION[AbstractPersistenceKeys::SESSION_LOGGED_IN]) && isset($_COOKIE[AbstractPersistenceKeys::COOKIE_SLI])) return new AuthenticatorToken($conn,$_COOKIE[AbstractPersistenceKeys::COOKIE_SLI],AbstractTokenTypes::COOKIE);
        return new AuthenticatorWeb($conn,new LoginResponseWeb());
    }
}