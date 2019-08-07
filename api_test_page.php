<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/06/2019
 * Time: 19:30
 */

session_start();
error_reporting(E_ALL);
//$host = "192.168.0.15/";//home
//$host = "192.168.0.22/";//work
$host = "localhost/";//public
$root = "/example/api?";
$apiType = "";
$apiCall = "";
$apiEndpoint = "";
$npc = "true";
$appVersion = "testPage";
$deviceOS = $host."/testPage";
$username = "";
$password = "";
$debug = false;

if(isset($_POST["submit"])) {
    $apiType = $_POST["api"];
    $apiCall = $_POST["call"];
    $apiEndpoint = $_POST["endpoint"];
    $npc = $_POST['npc'];

    $jsonPost = json_decode($_POST["jsonPost"],true);
    $jsonPost["username"] = $_POST['username'];
    $jsonPost["password"] = $_POST['password'];
    $jsonPost["loginToken"] = $_POST["loginToken"];

    $jsonPost["appVersion"] = $appVersion;
    $jsonPost["deviceOS"] = $deviceOS;
    $jsonPost["deviceId"] = $deviceOS;

    if(isset($jsonPost["debug"])) {
        $_SESSION["debug"] = true;
    }

    if(isset($jsonPost["buggedOut"])) unset($_SESSION["debug"]);
    $jsonPost = addslashes(json_encode($jsonPost));

    $url = $host . $root . "&npc=" . $npc . "&api=" . $apiType . "&call=" . $apiCall . "&endpoint=" . $apiEndpoint . "&ts=" . time();
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => ["jsonPost" => $jsonPost]
    ]);
    $resp = curl_exec($curl);
    curl_close($curl);

    if(isset($_SESSION["debug"])) var_dump($resp);

    $response = json_decode($resp);

    $_POST["loginToken"] = $response->response->loginToken;

    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            break;
        case JSON_ERROR_DEPTH:
            echo ' - Maximum stack depth exceeded';
            break;
        case JSON_ERROR_STATE_MISMATCH:
            echo ' - Underflow or the modes mismatch';
            break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Unexpected control character found';
            break;
        case JSON_ERROR_SYNTAX:
            echo ' - Syntax error, malformed JSON';
            break;
        case JSON_ERROR_UTF8:
            echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
            break;
        default:
            echo ' - Unknown error';
            break;
    }
}

?>

<html>

<head>

</head>

<body>
<form action="api_test_page.php" method="post">
    <label>api</label><input name="api" value="<?echo $_POST["api"]??'json'?>" type="text"><br />
    <label>npc</label><input name="npc" value="<?echo $_POST["npc"]??'true'?>" type="text"><br />
    <label>call</label><input name="call" value="<?echo $_POST["call"]??''?>" type="text"><br />
    <label>endpoint</label><input name="endpoint" value="<?echo $_POST["endpoint"]??''?>" type="text"><br />
    <label>username</label><input name="username" value="<?echo $_POST["username"]??''?>" type="text"><br />
    <label>password</label><input name="password" value="<?echo $_POST["password"]??''?>" type="text"><br />
    <label>loginToken</label><input name="loginToken" value="<?echo $_POST["loginToken"]??''?>" type="text"><br />
    <label>post</label><textarea rows="4" name="jsonPost" ><?echo $_POST["jsonPost"]?? '{}'?></textarea><br />
    <button name="submit">Send request</button>
</form>
        <pre>
        <?
        //        foreach($api as $key => $value) {
        //            echo '<h4>' . $key . '</h4>';
        //            if(is_object($value) || is_array($value)) {
        //                echo '<ul>';
        //                foreach ($value as $k => $v) {
        //                    echo '<li>' . $k . " => " . $v . " (" . gettype($v) . ")";
        //                }
        //                echo '</ul>';
        //            } else echo $value;
        //            echo '<hr>';
        //        }
        if(isset($response))print_r($response->response);
        ?>
        </pre>
</body>

</html>
