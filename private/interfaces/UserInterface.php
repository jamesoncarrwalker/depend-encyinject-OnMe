<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 16/07/2019
 * Time: 13:34
 */

namespace interfaces;


use abstractClasses\AbstractUser;

interface UserInterface {

    public function getUser() : AbstractUser;

}