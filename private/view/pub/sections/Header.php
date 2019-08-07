<?php

namespace view\pub\sections;

use interfaces\ViewInterface;

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/08/2019
 * Time: 20:11
 */
class Header implements ViewInterface {

    public $name;
    protected $html;
    private $links;

    public function __construct() {
        $this->setLinks();
    }

    public function setViewContent() {
        $html = '
            <div class="container-fluid">
                 <div class="row header">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        ' . $this->drawLinks() . '
                    </div>
                </div>
            </div>';
        $this->html = $html;
    }

    public function getViewContent() : string {
        $this->setViewContent();
        return $this->html;
    }

    private function setLinks() {
        $links = [
            'Login' => '/login'
        ];
        $this->links = $links;
    }

    private function drawLinks() :string {
        $output = '<ul class="list-unstyled list-inline">';
        foreach($this->links as $title => $path) {
            $output .= '<li> <a href="' . $path . '">' . $title . '</a></li>';
        }
        $output .= '<ul>';
        return $output;
    }
}