<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 28/07/2019
 * Time: 18:21
 */

namespace controller;


use abstractClasses\AbstractDBO;
use abstractClasses\AbstractWebController;
use model\authenticators\AuthenticatorWeb;
use view\landing\LandingPage;

class Dashboard extends AbstractWebController {


    function setPage() {

    }

    function getDefaultRequest() {
        // TODO: Implement getDefaultRequest() method.
    }

    function loadDashboard() {
        //add some sections
        $this->setPage();
    }
}