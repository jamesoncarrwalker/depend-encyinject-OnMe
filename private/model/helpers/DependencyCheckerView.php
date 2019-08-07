<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 04/08/2019
 * Time: 16:47
 */

namespace model\helpers;

use constants\AbstractDependencyTypes;
use constants\AbstractResourceTypes;
use interfaces\DependenciesInterface;
use model\classes\Dependency;

class DependencyCheckerView implements DependenciesInterface {

    private $sectionDependencies;
    private $pageViewDependencies;
    private $requestParams;

    public function __construct(array $requestParams) {
        $this->requestParams = (object)$requestParams;
        $this->setDependencies();
    }

    public function setDependencies() {
        $this->setSectionDependencies();
        $this->setPageViewDependencies();
    }

    public function hasDependencies(string $name, string $type = "VIEW") : bool {
        switch($type) {
            case AbstractResourceTypes::SECTION_VIEW :
                return isset($this->sectionDependencies[$name]);
            default:
                return isset($this->pageViewDependencies[$name]);
        }
    }

    public function getDependencies(string $name, string $type = "VIEW") {
        switch($type) {
            case AbstractResourceTypes::SECTION_VIEW :
                return $this->sectionDependencies[$name];
            default:
                return $this->pageViewDependencies[$name];
        }
    }

    private function setSectionDependencies() {
        $this->sectionDependencies = [
            'pub/Header' =>
                [

                ]
        ];
    }

    private function setPageViewDependencies() {

    }
}