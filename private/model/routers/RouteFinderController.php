<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 15/07/2019
 * Time: 23:39
 */

namespace model\routers;

use interfaces\ControllerInterface;
use interfaces\DependenciesInterface;
use interfaces\RouteFinderInterface;
use model\helpers\DependencyCheckerController;


class RouteFinderController implements RouteFinderInterface, DependenciesInterface {

    protected $controllerName;
    protected $route;
    protected $controllerLocation;
    protected $dependencyChecker;
    protected $dependencies;

    public function __construct(DependencyCheckerController $dependencyChecker) {
        $this->dependencyChecker = $dependencyChecker;
    }

    public function setEndpoint(string $endpoint) {
        $this->controllerName = ($endpoint == '' || $endpoint == null) ? 'Landing' : ucfirst($endpoint);
    }

    public function checkRouteIsValid() : bool {
        return file_exists('private/controller/' . $this->controllerName . '.php');
    }

    public function setRoute() {
        $this->controllerLocation = 'private/controller/' . $this->controllerName . '.php';
        $this->route = "\\controller\\" . $this->controllerName;
    }

    public function updateControllerName(string $name) {
        $this->controllerName = $name;
    }

    public function getRoute() : string {
        return $this->route;
    }

    public function returnResult() : ControllerInterface {
        require_once($this->controllerLocation);
        if($this->hasDependencies('','')) {

            $this->setDependencies();

            return new $this->route(...$this->getDependencies('',''));
        } else return new $this->route();
    }

    public function hasDependencies(string $name,string $type) : bool {
        return $this->dependencyChecker->hasDependencies($this->controllerName);
    }

    public function setDependencies() {
        foreach($this->dependencyChecker->getDependencies($this->controllerName) as $dependency) {
            if($dependency->value != null) $this->dependencies[] = $dependency->value;

        }
    }

    public function getDependencies(string $name,string $type) {
        return $this->dependencies;
    }
}