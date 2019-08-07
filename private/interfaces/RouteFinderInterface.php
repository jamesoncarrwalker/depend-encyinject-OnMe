<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 15/07/2019
 * Time: 23:28
 */

namespace interfaces;

interface RouteFinderInterface {

    public function setEndpoint(string $endPoint);

    public function setRoute();

    public function checkRouteIsValid() : bool;

    public function getRoute() : string;

    public function returnResult();
}