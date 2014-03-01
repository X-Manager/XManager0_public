<?php

session_start();

require_once dirname(__FILE__)."/chat/src/phpfreechat.class.php";
$params = array();

$params["title"] = "X-Chat";


if (array_key_exists("usrlogin", $_SESSION)) {
	$params["nick"] = $_SESSION["usrlogin"];
} else {
	$params["nick"] = "guest".rand(1,1000).rand(1,1000).rand(1,10000);
}

$params["language"]      = "pt_PT";
$params["isadmin"] = false; // makes everybody admin: do not use it on production servers ;)
$params["serverid"] = md5(__FILE__); // calculate a unique id for this chat
$params["debug"] = false;
$chat = new phpFreeChat( $params );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />

        <?php $chat->printJavascript(); ?>
        <?php $chat->printStyle(); ?>

    </head>

    <body>
        <?php $chat->printChat(); ?>

    </body>
</html>

