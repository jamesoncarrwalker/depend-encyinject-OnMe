<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/08/2019
 * Time: 21:48
 */

namespace view\landing;

use abstractClasses\AbstractPublicPage;
use constants\AbstractResourceTypes;
use view\pub\sections\Header;

class LandingPage extends AbstractPublicPage {

    private $header;

    public function __construct(Header $header,array $resources) {
        parent::__construct();
        foreach($resources as $resource) {
            if($resource->type == AbstractResourceTypes::CSS) $this->css[] = $resource->location;
            else if($resource->type == AbstractResourceTypes::JS) $this->js[] = $resource->location;
        }
        //define which views this page depends on
        $this->header = $header;
    }

    public function setBody() {
       $this->body = $this->header->getViewContent() . '
        <body>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> <h1>HELLO WORLD!!!</h1></div>
        </body>';
    }
}