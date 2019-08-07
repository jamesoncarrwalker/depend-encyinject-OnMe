<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 26/07/2019
 * Time: 12:31
 */

namespace model\responseObjects;


use abstractClasses\AbstractPage;
use interfaces\ResponseInterface;


class WebResponse implements ResponseInterface {

    private $page;
    public $errors;
    public $messages;
    public $redirect;
    public $status;
    public $output;

    public function __construct(AbstractPage $page) {
        $this->page = $page;
    }

    public function setResponseErrors() {
        // TODO: Implement setResponseErrors() method.
    }

    public function setResponseMessages() {
        // TODO: Implement setResponseMessages() method.
    }

    public function setResponseStatus() {
        // TODO: Implement setResponseStatus() method.
    }

    public function getResponsesStatus(int $responseStatus) {
        $this->status = $responseStatus;
    }

    public function setOutput() {
        $this->page->setHead();
        $this->page->setBody();
        $this->page->setTemplate();
        $this->output = $this->page->head . $this->page->body . '</html>';
    }

    public function getOutput() {
        return $this->output;
    }

    public function setRedirect(string $location) {
        // TODO: Implement setRedirect() method.
    }
}