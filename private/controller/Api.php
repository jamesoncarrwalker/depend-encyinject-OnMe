<?php

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/06/2019
 * Time: 20:36
 *
 * this is basically a redirect to easily maintain the routing system and send
 * the call to the correct format (json,xml etc)  - the controller for each one
 * is located in it's correct folder.  This class has no real knowledge of what
 * it is being asked to do
 *
 */
namespace controller;

use abstractClasses\AbstractApiController;


class Api extends AbstractApiController  {

    public function setDefaultRequest() {

    }

    public function ajaxRequest() {

    }

    public function setResponse($response) {

    }

}