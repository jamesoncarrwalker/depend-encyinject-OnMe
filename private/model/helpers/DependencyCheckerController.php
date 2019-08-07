<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 25/07/2019
 * Time: 13:04
 */

namespace model\helpers;


use abstractClasses\AbstractDBO;
use constants\AbstractDependencyTypes;
use interfaces\DependenciesInterface;
use model\authenticators\AuthenticatorWeb;
use model\classes\Dependency;
use model\responseObjects\LoginResponseWeb;
use model\routers\RouteFinderView;

class DependencyCheckerController implements DependenciesInterface {

    private $controllerDependencies;
    private $conn;
    public $authenticatorWeb;
    public $routeFinderView;
    public $dependencyCheckerView;
    public $requestData;
    protected $webControllerDependencies;

    public function __construct(AbstractDBO $conn,array $requestData) {
        $this->conn = $conn;
        $this->requestData = (object) $requestData;
        $this->setWebControllerDependencies();
        $this->setDependencies();
    }
    private function getFilteredRequestData(array $filters) {

    }

    public function hasDependencies(string $className,string $classType = 'controller') : bool {
       switch($classType) {
           default:
               return isset($this->controllerDependencies[$className]);
       }
    }

    public function getDependencies(string $className,string $classType = 'controller') {
        switch($classType) {
            default:
                return $this->controllerDependencies[$className];
        }
    }

    public function setDependencies(){
        $this->controllerDependencies = [
            'Login' =>
                [
                    new Dependency(AbstractDependencyTypes::DBCONN,$this->conn),
                    new Dependency(AbstractDependencyTypes::AUTHENTICATOR,GetAuthenticator::getLoginAuthenticator($this->conn))
                ],
            'Landing' => $this->webControllerDependencies,

            'Dashboard' => $this->webControllerDependencies,

        ];
    }

    private function setWebControllerDependencies() {
        $this->webControllerDependencies = [
            new Dependency(AbstractDependencyTypes::DBCONN,$this->conn),
            new Dependency(AbstractDependencyTypes::AUTHENTICATOR,$this->getAuthenticatorWeb()),
            new Dependency(AbstractDependencyTypes::ROUTER,$this->getRouteFinderView())];
    }

    private function getAuthenticatorWeb() : AuthenticatorWeb {
        if($this->authenticatorWeb == null) $this->authenticatorWeb = new AuthenticatorWeb($this->conn,new LoginResponseWeb());
        return $this->authenticatorWeb;
    }

    private function getRouteFinderView() : RouteFinderView {
        if($this->routeFinderView == null) $this->routeFinderView = new RouteFinderView($this->getDependencyCheckerView());
        return $this->routeFinderView;
    }

    private function getDependencyCheckerView() :DependencyCheckerView {
        if($this->dependencyCheckerView == null) $this->dependencyCheckerView = new DependencyCheckerView((array) $this->requestData);
        return $this->dependencyCheckerView;
    }


}