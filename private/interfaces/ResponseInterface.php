<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 30/07/2019
 * Time: 13:41
 */

namespace interfaces;


interface ResponseInterface {

    public function setResponseErrors();

    public function setResponseMessages();

    public function setResponseStatus();

    public function getResponsesStatus(int $responseStatus);

    public function setOutput();

    public function getOutput();

    public function setRedirect(string $location);

}