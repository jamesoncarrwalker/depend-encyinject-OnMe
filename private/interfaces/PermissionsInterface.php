<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 15/07/2019
 * Time: 19:52
 */

namespace interfaces;


use \abstractClasses\AbstractUser;

interface PermissionsInterface {

    public function setMinimumRole();

    public function updateMinimumRole();

    public function isAllowedAccess(AbstractUser $user) : bool;
}