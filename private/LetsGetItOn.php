<?php

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/06/2019
 * Time: 19:34
 */

use abstractClasses\AbstractDBO;
use constants\AbstractLaundryCycle;
use interfaces\ControllerInterface;
use model\helpers\DependencyCheckerController;
use model\helpers\WashingMachine;
use model\responseObjects\AjaxResponse;
use model\responseObjects\ApiResponse;
use model\responseObjects\LoginResponseApi;
use model\responseObjects\LoginResponseWeb;
use model\responseObjects\WebResponse;
use model\routers\RouteFinderController;
use model\dbo\DBPdo;
use controller\Login;

class letsGetItOn {

    protected $urlParams;
    protected $postParams;
    protected $controllerResponse;
    protected $controller;
    public $output;

    function __construct() {
        //clean any inputs
        //bootstrap this baby up
        $this->setAutoLoader();
        $conn = $this->setConnection();
        $washingMachine = new WashingMachine();
        if(count($_POST) > 0) {
            $washingMachine->setCycle(AbstractLaundryCycle::POST);
            $washingMachine->loadLaundry($_POST);
            $washingMachine->runCycle();
            $this->postParams = $washingMachine->getLaundry();
        }
        parse_str($_SERVER["QUERY_STRING"],$this->urlParams);
        $washingMachine->setCycle(\constants\AbstractLaundryCycle::POST);
        $washingMachine->loadLaundry($this->urlParams);
        $washingMachine->runCycle();
        $this->urlParams = $washingMachine->getLaundry();
        //give the DI checker the clean data
        $dependencyChecker = new DependencyCheckerController($conn,array_merge($this->postParams??[],$this->urlParams??[]));

        //get a controller
        $routeFinder = new RouteFinderController($dependencyChecker);
        $this->controller = $this->getController($routeFinder);

        if($this->controller instanceof Login) {
            $this->controller->doLogin();
            $this->setLoginResponse();
        } else {
            $this->controller->runRequest();
            $this->controller->setResponse();
            $this->controllerResponse = $this->controller->getResponse();
            $this->setOutput();
        }
    }


    private function setAutoLoader() {
        return spl_autoload_register(
            function($class) {
                $class = 'private/' .  str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
                if(file_exists($class)) include_once $class;
                else die('Classic case of ' . $class . ' not found');
            }
        );
    }

    private function setConnection() : AbstractDBO {
        //may want to change connections or have alternatives available in the future
        return new DBPdo(parse_ini_file("example.ini",true)["PDO_CONNECT"]);
    }

    private function getController(RouteFinderController $routeFinder) : ControllerInterface {
        $routeFinder->setEndpoint(key($this->urlParams)??'');
        if(!$routeFinder->checkRouteIsValid()) $routeFinder->updateControllerName('AllThoseWhoWander');
        $routeFinder->setRoute();
        return $routeFinder->returnResult();
    }

    private function setLoginResponse() {
        $loginResponse = $this->controller->getResponse();
        if($loginResponse instanceof LoginResponseApi) /*echo $loginResponse;*/ return true;
        else if ($loginResponse instanceof LoginResponseWeb) header("Location: " . BASE_URL);
        else die('LOGIN ERROR');
    }

    private function setOutput() {
        if(isset($this->controllerResponse->redirect)) {
            //do the redirect
            //die();
        } else if ($this->controllerResponse instanceof WebResponse) {
            //out put a web page
            $this->controllerResponse->setOutput();
            echo $this->controllerResponse->getOutput();
        } else if ($this->controllerResponse instanceof ApiResponse) {
            //output a json api string
        } else if ($this->controllerResponse instanceof AjaxResponse) {
            //output the ajax string
        } else {
            //output an error
        }
    }
}