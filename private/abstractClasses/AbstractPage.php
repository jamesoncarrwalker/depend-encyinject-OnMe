<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/08/2019
 * Time: 21:41
 */

namespace abstractClasses;

use interfaces\PageInterface;

abstract class AbstractPage implements PageInterface {

    protected $css = [];
    protected $js = [];
    public $head;
    public $body;
    protected $sections = [];
    protected $routeFinderView;
    protected $dependencyChecker;

    public function setHead() {
        $this->head = '<!DOCTYPE html>
                            <html>
                                <head>'
                                    . implode('',$this->css)
                                    . implode('',$this->js) .
                                '</head>';
    }
}