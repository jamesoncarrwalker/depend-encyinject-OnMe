<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 23/07/2019
 * Time: 14:19
 */

namespace interfaces;


interface AuthenticatorInterface {

    public function setAuthenticationParams();

    public function checkRequiredParamsSet() : bool;

    public function authenticate();

    public function getAuthenticationResponse();

}