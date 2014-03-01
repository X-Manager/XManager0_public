<?php session_start(); ?>

<?php

include_once('maniadb.php');
include_once('config.php');
include_once("simulador.php");

updateInfo();

function getXLSRelatorio() {
    setlocale(LC_ALL, "pt_BR.utf-8");
    $db = new maniadb;
    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);

    $initTime = intval($_SESSION['TimeInit']);
    $roundDuration = intval($_SESSION['RoundDuration']);
    $TimeEnd = intval($_SESSION['TimeEnd']);

    $time = time();
    $round = intval(($time - $initTime) / $roundDuration);


    $rodada = $_GET['rodada'];
    $usrlogin = $_SESSION['usrlogin'];
    $roomid = $_SESSION['RoomId'];


    $idplayer = $_SESSION['usrid'];
    $round = min($round - 1, $rodada);

    $IP = $_SERVER['REMOTE_ADDR'];
    $db->query("INSERT INTO `relatorioLogs`(IP,time,id_player, round, id_room) VALUES('$IP'," . time() . ", $idplayer, $round, $roomid)");

    header('Content-type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="xmanager_rodada=' . ($round + 1) . '_idplayer=' . $idplayer . '_time=' . time() . '.xls"');

    //$_SESSION['RelMaxRound'] = -1;
    //getMaxRod($idplayer);

    $id = $roomid;

    $time = time();

    $dbn = array('Fluxo de caixa',
	'Demonstrativo de Resultados',
	'Dados para tomada de decisao',
	'Balanco',
	'decisions');


    $linha = array();
    //foreach ($dbn as $v) {
    for ($i = 0; $i < 5; ++$i) {
	$v = $dbn[$i];
//$DecisionMap
	$n = 0;

	if (array_key_exists($n, $linha)) {
	    switch ($v) {
		case 'decisions': $linha[$n] .= "  Decisao  tomada\t \t \t ";
		    break;
		default: $linha[$n] .= " " . $v . "  \t \t \t ";
		    break;
	    }
	} else {
	    switch ($v) {
		case 'decisions': $linha[$n] = " Decisao tomada\t \t \t ";
		    break;
		default: $linha[$n] = "  " . $v . "  \t \t \t ";
		    break;
	    }
	}
	++$n;
	$linha[$n] = "\r\n";
	++$n;
	if ($round < 0) {
	    $loid = -$_SESSION['Tipo cenario'];
	    $query = "SELECT * FROM `$v` WHERE id_player = $loid AND id_room = $loid AND round = $loid";
	} else {
	    $query = "SELECT * FROM `$v` WHERE id_player = $idplayer AND id_room = $id AND round = $round";
	}
	$db->query($query);
	$row = $db->nextRow();

	if (!$row) {
	    $db->close();
	} else {
	    foreach ($row as $key => $value) {

		switch ($key) {
		    case 'id': case 'id_player': case 'id_room': case 'round' : case 'time': case 'salvarDecisao':
		    case 'Depreciacao Maquinas Acumulada': case 'Depreciacao Predial Acumulada':
		    case 'Juros vendas a prazo para receber':
			break;

		    default:
			$value = floatval($value);

			if (array_key_exists($n, $linha)) {
			    switch ($key) {
				case 'Engenheiro':
				case 'Secretaria':
				case 'Administrador':
				case 'Vendedor':
				    $c = $value;
				    switch (intval($value)) {
					case 0: $c = 'A';
					    break;
					case 1: $c = 'B';
					    break;
					case 2: $c = 'C';
					    break;
				    }
				    $value = $c;

				    break;
			    }
			    switch ($v) {
				case 'decisions':

				    $c = '?';
				    $k = intval($value);

				    switch ($k) {
					case 0: $c = 'A';
					    break;
					case 1: $c = 'B';
					    break;
					case 2: $c = 'C';
					    break;
				    }
				    switch ($key) {
					case 'deengenheiro': case 'deadministrador': case 'desecretaria': case 'devendedor':
					    $value = $c;
					    break;
				    }

				    $linha[$n] .= $GLOBALS['DecisionMap'][$key] . " \t $value \t \t ";
				    break;
				default: $linha[$n] .= "$key \t $value \t \t ";
				    break;
			    }
			} else {
			    switch ($v) {
				case 'decisions':
				    $linha[$n] = "" . $GLOBALS['DecisionMap'][$key] . " \t $value \t \t ";
				    break;
				default: $linha[$n] = "$key \t $value \t \t ";
				    break;
			    }
			}
			++$n;
			break;
		}
	    }

	    if (array_key_exists($n, $linha)) {
		$linha[$n] .= " \t \t \t ";
	    } else {
		$linha[$n] = " \t \t \t";
	    }
	    ++$n;

	    $db->free();
	}
    }
    echo "  Xmanager " . date('Y') . "  \r\n";
    echo "  Data  : " . date('d/m/Y H:i:s') . "  \r\n";
    echo "  Rodada   : " . ($round + 1) . "  \r\n";
    echo "  Jogador  : " . $usrlogin . "  \r\n";
    echo "  Sala  : " . $roomid . "  \r\n";
    foreach ($linha as $v) {
	echo " \t \t " . $v . "\r\n";
    }

    echo " (c) Copyright " . date('Y') . " GoHug \r\n";
    echo "Software desenvolvido por Pericles Lopes Machado e Huiran Fornazieri. \r\n";

    $db->close();
}

getXLSRelatorio();
?>


