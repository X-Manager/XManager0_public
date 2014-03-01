<?php

include_once ("config.php");
include_once ("maniadb.php");

function add_user($usr, $pwd) {
    if (!(parser($usr) && parser($pwd))) {
	logXManager("Você digitou uma entrada inválida!\n");
	return false;
    }

    $db = new maniadb;
    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);

    $db->query("SELECT * FROM users WHERE name = '$usr'");
    $row = $db->nextRow();

    if ($row) {
	$db->free();
	logXManager("\'$usr\' já está presente no database!\n");
	return false;
    }

    if ($db->query(
		    "INSERT INTO users(name, privilege, pwd) " .
		    "VALUES('$usr', 0,'" . md5($pwd) . "')")) {
	logXManager("\'$usr\' adicionado com sucesso!\n");
    } else {
	logXManager("Falha ao inserir \'$usr\' no database!\n");
    }

    $db->close();
    return true;
}

function authenticate_user($usr, $pwd) {
    if (!(parser($usr) && parser($pwd))) {
	logXManager("Você digitou uma entrada inválida!\n");
	return false;
    }

    $db = new maniadb;
    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);

    $db->query("SELECT * FROM users WHERE name = '$usr'");
    $row = $db->nextRow();

    if (!$row) {
	$db->free();
	logXManager("\'$usr\' não está presente no database!\n");
	return false;
    }

    if ($row['pwd'] == md5($pwd)) {
	$_SESSION["usrlogin"] = $usr;
	$_SESSION["usrid"] = $row['id'];
	$_SESSION["usrpriv"] = $row['privilege'];
	$_SESSION["usrrating"] = $row['rating'];

	logXManager("Olá <b>$usr</b>!");
	$id = $row['id'];
	$IP = $_SERVER['REMOTE_ADDR'];
	$db->query("INSERT INTO `loginLogs`(IP,time,id_player) VALUES('$IP'," . time() . ", $id)");
    } else {
	logXManager("Acesso negado!<p>");
    }

    $db->close();
    return true;
}

// lcp inciso 5
?>


