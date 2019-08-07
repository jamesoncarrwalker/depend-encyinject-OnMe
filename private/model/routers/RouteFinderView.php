<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 30/07/2019
 * Time: 13:23
 */

namespace model\routers;

use interfaces\DependenciesInterface;
use interfaces\RouteFinderInterface;
use interfaces\ViewInterface;
use model\helpers\DependencyCheckerView;

class RouteFinderView implements RouteFinderInterface, DependenciesInterface {

    protected $route;
    protected $viewLocation;
    protected $viewName;
    protected $dependencyChecker;
    protected $dependencies;

    public function __construct(DependencyCheckerView $dependencyChecker) {
        $this->dependencyChecker = $dependencyChecker;
    }

    public function setEndpoint(string $viewName) {
        $this->viewName = $viewName;
        if($this->checkRouteIsValid()){
            $this->setRoute();
        }
    }

    public function checkRouteIsValid() : bool {
        return file_exists('private' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . $this->viewName . '.php');
    }

    public function setRoute() {
        $this->viewLocation = 'private' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . $this->viewName . '.php';
        $this->route = "\\view\\" . str_replace(DIRECTORY_SEPARATOR, '\\', $this->viewName);
    }

    public function getRoute() : string {
        return $this->route;
    }

    public function returnResult() : ViewInterface {
        require_once($this->viewLocation);
        if($this->hasDependencies('','')) {
            //call user fun array somehow
            $this->setDependencies();

            return new $this->route(...$this->getDependencies('',''));
        } else return new $this->route();
    }
    public function hasDependencies(string $name, string $type) : bool {
        return $this->dependencyChecker->hasDependencies($this->viewName);
    }

    public function setDependencies() {
        foreach($this->dependencyChecker->getDependencies($this->viewName) as $dependency) {
            $this->dependencies[] = $dependency->value;
        }
    }

    public function getDependencies(string $name, string $type) {
        return $this->dependencies ?? [];
    }
}