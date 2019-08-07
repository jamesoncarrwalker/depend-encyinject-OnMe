<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 25/07/2019
 * Time: 13:13
 */

namespace constants;


abstract class AbstractDependencyTypes {
    const DBCONN = 1;
    const AUTHENTICATOR = 2;
    const STRING = 3;
    const INT = 4;
    const BOOL = 5;
    const ARRAY = 6;
    const ROUTER = 7;
    const DEPCHECK = 8;
    const POSTVAR = 9;
    const GETVAR = 10;
}