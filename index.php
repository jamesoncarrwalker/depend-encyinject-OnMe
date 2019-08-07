<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/06/2019
 * Time: 19:29
 */

session_start();
//$_SESSION['DEBUG'] = true;

header('Expires: Sat 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s' . ' GMT'));
header('Cache-control: cache, must-revalidate');
header('Pragma: public');

$reporting = isset($_SESSION['DEBUG'])? E_ALL : 0;;
require_once('globals.php');
require_once('private/LetsGetItOn.php');
new letsGetItOn();
