<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 18/07/2019
 * Time: 14:47
 */

namespace interfaces;


interface LoggedInInterface {

    public function mustBeLoggedIn();

    public function isLoggedIn(bool $isLoggedIn);
}