<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 15/07/2019
 * Time: 21:10
 */

namespace abstractClasses;

use constants\AbstractResourceTypes;
use interfaces\ControllerInterface;
use interfaces\LoggedInInterface;
use interfaces\ResourcesInterface;
use interfaces\UserInterface;
use model\authenticators\AuthenticatorWeb;
use model\classes\Resource;
use model\responseObjects\WebResponse;
use model\routers\RouteFinderView;

abstract class AbstractWebController implements ControllerInterface, UserInterface, LoggedInInterface, ResourcesInterface {

     protected $response;
     protected $mustBeLoggedIn;
     protected $isLoggedIn;
     protected $request;
     protected $requestParams;
     protected $postParams;
     protected $conn;
     protected $authenticator;
     protected $routeFinderView;
     protected $views;
     protected $resources;
     protected $page;

     public function __construct(AbstractDBO $conn, AuthenticatorWeb $authenticator, RouteFinderView $routeFinderView) {
         $this->conn = $conn;
         $this->authenticator = $authenticator;
         $this->isLoggedIn = $this->authenticator->authenticate();
         $this->routeFinderView = $routeFinderView;
     }

     public function runRequest() {
        $method = $this->requestParams->request ?? $this->getDefaultRequest();
        $this->$method();
     }

     public function setResponse() {
         $this->response = new WebResponse($this->page);
     }

     public function getResponse() : WebResponse {
         return $this->response;
     }

     public function getUser() : AbstractUser {

     }

     public function mustBeLoggedIn() {
         $this->mustBeLoggedIn = false;
     }

     public function isLoggedIn(bool $isLoggedIn) {
        $this->isLoggedIn = $isLoggedIn;
     }


     abstract function getDefaultRequest();

     public function isValidRequest() {
         // TODO: Implement isValidRequest() method.
     }

    abstract function setPage();//needs to be passed down to the child

    public function addResource(string $type, string $name, string $location, array $params = []) {
        if(in_array($type, [AbstractResourceTypes::PAGE_VIEW,AbstractResourceTypes::SECTION_VIEW])) $this->addView($name,$location,$params);
        elseif(in_array($type, [AbstractResourceTypes::CSS,AbstractResourceTypes::JS])) $this->addScript($type,$name,$location);
    }

    public function removeResource(string $name, string $type) {
        if($type == AbstractResourceTypes::CSS) unset($this->resources['css'][$name]);
        else if ($type == AbstractResourceTypes::JS)unset($this->resources['js'][$name]);
        else if (in_array($type, [AbstractResourceTypes::PAGE_VIEW,AbstractResourceTypes::SECTION_VIEW])) unset($this->views[$name]);
    }

    public function getResource(string $name, string $type) {
        // TODO: Implement getResource() method.
    }

    private function addView(string $name, string $location,array $params = []) {
        $endPoint = $name . DIRECTORY_SEPARATOR . ($location == null ?  ucfirst(strtolower($name)) . 'Page' : 'sections' . DIRECTORY_SEPARATOR . $location );
        $this->routeFinderView->setEndpoint($endPoint);
        $this->views[$location??$name] = $this->routeFinderView->returnResult();
    }

    private function addScript(string $type, string $name, string $location) {
        if($type == AbstractResourceTypes::CSS) $this->resources[$name] = new Resource($type,$name,'<link href="private/css/'.  $location . '" rel="stylesheet"/>');
        else if ($type == AbstractResourceTypes::JS)$this->resources[$name] = '<script src="'.  $location . '" type="text/javascript"></script>';
    }
}