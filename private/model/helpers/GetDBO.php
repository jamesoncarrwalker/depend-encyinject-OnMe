<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 26/07/2019
 * Time: 12:55
 */

namespace model\helpers;


use model\dbo\DBPdo;

class GetDBO {

    static public function getDBO(string $type,array $connectionVars) {
        switch($type) {
            default:
                return new DBPdo($connectionVars);
        }
    }
}