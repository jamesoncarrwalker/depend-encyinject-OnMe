<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 07/07/2019
 * Time: 17:10
 */

namespace controller;


use abstractClasses\AbstractDBO;
use abstractClasses\AbstractWebController;
use constants\AbstractResourceTypes;
use model\authenticators\AuthenticatorWeb;
use model\routers\RouteFinderView;
use view\landing\LandingPage;

class Landing extends AbstractWebController {

    public function __construct(AbstractDBO $conn, AuthenticatorWeb $authenticator, RouteFinderView $routeFinderView) {
        parent::__construct($conn, $authenticator, $routeFinderView);
    }


    public function getDefaultRequest() {

        $this->isLoggedIn = false;
        if($this->isLoggedIn) return 'loadDashboardPage';
        else return 'loadLandingPage';
    }

    public function loadLandingPage() {
        $this->addResource(AbstractResourceTypes::CSS,'style.css','style.css');
        $this->addResource(AbstractResourceTypes::CSS,'landingCss2','landing.css');
        $this->addResource(AbstractResourceTypes::CSS,'pageCss','pagecss.css');
        $this->addResource(AbstractResourceTypes::CSS,'pageJs','pagecss.js');
        $this->addResource(AbstractResourceTypes::SECTION_VIEW,'pub','header',[]);
        $this->setPage();
    }


    public function loadDashboardPage() {
        header("Location:" . BASE_URL . '/dashboard');
    }

    function setPage() {
        $this->page = new LandingPage($this->views['header'],$this->resources);
    }
}