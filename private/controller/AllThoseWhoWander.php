<?php

namespace controller;

use abstractClasses\AbstractWebController;



/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/06/2019
 * Time: 20:01
 */
class AllThoseWhoWander extends AbstractWebController {

    public function setDefaultRequest() {
        $this->request = 'loadLostPage';
    }

    public function loadLostPage() {
        $this->setResponse('Not all those who wander are lost');
    }

    public function setResponse($response) {
        $this->response = $response;
    }
}