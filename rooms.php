<?php

include_once ("config.php");
include_once ("maniadb.php");
include_once ("simulador.php");

function print_date($date) {
    $d = floor($date / 86400);
    $h = floor(($date % 86400) / 3600);
    $m = floor((($date % 86400) % 3600) / 60);
    $s = (($date % 86400) % 3600) % 60;

    if ($d <= 1.01) {
	printf("%d dia %02d:%02d:%02d ", $d, $h, $m, $s);
    } else {
	printf("%d dias %02d:%02d:%02d ", $d, $h, $m, $s);
    }
}

function viewRoom($id) {

    $_GLOBALS['isdecision'] = false;
    $_GLOBALS['isrelatorio'] = false;
    $_GLOBALS['issimulador'] = false;
    $_GLOBALS['isinfo'] = false;
    $_GLOBALS['isrank'] = false;

    if (!inputValidation()) {
	include_once('roomForm.php');
	return false;
    }

    $db = new maniadb;
    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);

    $db->query("SELECT * FROM rooms WHERE id = $id");

    $row = $db->nextRow();

    foreach ($row as $key => $value) {
	$$key = $value;
    }

    $_SESSION['Tipo cenario'] = $row['Tipo cenario'];
    $_SESSION['RoomName'] = $name;
    $_SESSION['RoomId'] = $id;
    $_SESSION['CurrRound'] = $current_round;
    $_SESSION['RoundDuration'] = $round_duration;
    $_SESSION['TimeInit'] = $time_init;

    $timeEndRound = intval($time_init) + (intval($current_round) + 1) * intval($round_duration);

    $_SESSION['TimeEnd'] = $timeEndRound;
    $_SESSION['nSlots'] = $slots;
    $_SESSION['weight'] = $weight;
    $_SESSION['nRounds'] = $nrounds;

    $_SESSION['RoomName'] = $name;
    $_SESSION['RoomId'] = $id;
    $_SESSION['CurrRound'] = $current_round;
    $_SESSION['RoundDuration'] = $round_duration;
    $_SESSION['TimeInit'] = $time_init;
    $_SESSION['TimeEnd'] = $timeEndRound;
    $_SESSION['nSlots'] = $slots;
    $_SESSION['weight'] = $weight;
    $_SESSION['nRounds'] = $nrounds;

    $nSlots = intval($slots);

    if ($nSlots > 0 and $current_round < 0.1) {

	$idplayer = $_SESSION['usrid'];

	$db->query("SELECT id_room FROM players WHERE id_player = $idplayer AND id_room = $id");

	if (!$db->nextRow()) {
	    $db->query("INSERT INTO players(id_room, id_player, pontuation) VALUES($id, $idplayer, 0)");
	    $db->query("UPDATE rooms SET slots = " . ($nSlots - 1) .
		    "  WHERE id = $id");
	}
    }

    $db->close();

    include_once('roomForm.php');

    return true;
}

function viewRelatorio() {

    $_GLOBALS['isdecision'] = false;
    $_GLOBALS['isrelatorio'] = true;
    $_GLOBALS['issimulador'] = false;
    $_GLOBALS['isinfo'] = false;
    $_GLOBALS['isrank'] = false;

    include_once('roomForm.php');
}

function viewRanking() {

    $_GLOBALS['isdecision'] = false;
    $_GLOBALS['isrelatorio'] = false;
    $_GLOBALS['issimulador'] = false;
    $_GLOBALS['isinfo'] = false;
    $_GLOBALS['isrank'] = true;

    include_once('roomForm.php');
}

function viewSimulador() {

    $_GLOBALS['isdecision'] = false;
    $_GLOBALS['isrelatorio'] = false;
    $_GLOBALS['issimulador'] = true;
    $_GLOBALS['isinfo'] = false;
    $_GLOBALS['isrank'] = false;

    include_once('roomForm.php');
}

function viewInfo() {

    $_GLOBALS['isdecision'] = false;
    $_GLOBALS['isrelatorio'] = false;
    $_GLOBALS['issimulador'] = false;
    $_GLOBALS['isinfo'] = true;
    $_GLOBALS['isrank'] = false;

    include_once('roomForm.php');
}

function viewDecisionRoom() {

    $_GLOBALS['isdecision'] = true;
    $_GLOBALS['isrelatorio'] = false;
    $_GLOBALS['issimulador'] = false;
    $_GLOBALS['isinfo'] = false;
    $_GLOBALS['isrank'] = false;

    if (!inputValidation()) {
	include_once('roomForm.php');
	return false;
    }


    $db = new maniadb;
    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);

    $idplayer = $_SESSION['usrid'];
    $id = $_SESSION['RoomId'];


    $db->query("SELECT id_room FROM players WHERE id_player = $idplayer AND id_room = $id");
    if (!$db->nextRow()) {
	$db->close();
	logXManager("Sala cheia!\n");
	return false;
    }


    $initTime = intval($_SESSION['TimeInit']);
    $roundDuration = intval($_SESSION['RoundDuration']);

    $time = time();
    $round = floor(($time - $initTime) / $roundDuration);
    if ($round <= 0) {
	$round = 0;
    }

    $db->query("SELECT * FROM decisions WHERE id_player = $idplayer AND id_room = $id AND round = $round");
    $row = $db->nextRow();

    if ($row) {
	foreach ($row as $key => $value) {
	    $_SESSION[$key] = $value;
	}
    }
    $db->close();

    include_once('roomForm.php');
}

function getCurrRound($idroom) {
    $db = new maniadb;
    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);

    $db->query("SELECT * FROM `rooms` WHERE id = $idroom");

    $row = $db->nextRow();
    $round = $row['current_round'];

    $_SESSION['RoomName'] = $row['name'];
    $_SESSION['RoomId'] = $row['id'];
    $_SESSION['RoomSeed'] = $row['seed'];
    $_SESSION['CurrRound'] = intval($row['current_round']);
    $_SESSION['RoundDuration'] = $row['round_duration'];
    $_SESSION['TimeInit'] = $row['time_init'];
    $_SESSION['TimeEnd'] = $row['time_init'] + ($row['current_round'] + 1) * $row['round_duration'];
    $_SESSION['nSlots'] = $row['slots'];
    $_SESSION['weight'] = $row['weight'];
    $_SESSION['nRounds'] = $row['nrounds'];

    $initTime = intval($_SESSION['TimeInit']);
    $roundDuration = intval($_SESSION['RoundDuration']);
    $TimeEnd = intval($_SESSION['TimeEnd']);

    $time = time();
    $roundt = intval(($time - $initTime) / $roundDuration);
    if ($roundt <= 0) {
	$roundt = 0;
    }

    if ($roundt > 0.1) {
	$db->query("UPDATE rooms SET slots = 0 WHERE id = $idroom ");
    }

    $db->close();

    return $round;
}

function saveDecisionRoom() {

    $_GLOBALS['isdecision'] = true;
    $_GLOBALS['isrelatorio'] = false;
    $_GLOBALS['issimulador'] = false;
    $_GLOBALS['isinfo'] = false;
    $_GLOBALS['isrank'] = false;

    if (!inputValidation()) {
	include_once('roomForm.php');
	return false;
    }


    $idplayer = $_SESSION['usrid'];
    $id = $_SESSION['RoomId'];

    $initTime = intval($_SESSION['TimeInit']);
    $roundDuration = intval($_SESSION['RoundDuration']);

    $time = time();
    $round = intval(($time - $initTime) / $roundDuration);
    if ($round <= 0) {
	$round = 0;
    }

    $db = new maniadb;

    $db->connectCall($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);
    $db->queryCall("CALL novaMedia(" . $id . "," . $round . ", @status);");
    $db->close();


    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);


    $db->query("SELECT id_room FROM players WHERE id_player = $idplayer AND id_room = $id");
    if (!$db->nextRow()) {
	$db->close();
	logXManager("Sala cheia!\n");
	return false;
    }

    foreach ($_POST as $key => $value) {
	$_SESSION[$key] = $value;
    }


    $db->query("SELECT id_room FROM decisions WHERE id_player = $idplayer AND id_room = $id AND round = $round");

    if (!$db->nextRow()) {

	$q = "INSERT INTO decisions(id_player, id_room, round, time," .
		"demateriaPrima, demaquinas, dehmmaquinas, denturnos, " .
		"deHoraExtra, dePD, depreco, dedesconto, deprazo, " .
		"depropaganda, deelp, deengenheiro, deadministrador, " .
		"desecretaria, deestagiarios, devendedor, desalarioOperario)" .
		" VALUES($idplayer, $id, $round, $time," .
		$_SESSION["demateriaPrima"] . "," . $_SESSION["demaquinas"] . "," .
		$_SESSION["dehmmaquinas"] . "," . $_SESSION["denturnos"] . "," .
		$_SESSION["deHoraExtra"] . "," . $_SESSION["dePD"] . "," .
		$_SESSION["depreco"] . "," . $_SESSION["dedesconto"] . "," .
		$_SESSION["deprazo"] . "," . $_SESSION["depropaganda"] . "," .
		$_SESSION["deelp"] . "," . $_SESSION["deengenheiro"] . "," .
		$_SESSION["deadministrador"] . "," . $_SESSION["desecretaria"] . "," .
		$_SESSION["deestagiarios"] . "," . $_SESSION["devendedor"] . "," .
		$_SESSION["desalarioOperario"] . ")";

	$db->query($q);
    } else {
	$q = "UPDATE decisions SET time = $time, " .
		" demateriaPrima = " . $_SESSION["demateriaPrima"] . "," .
		" demaquinas = " . $_SESSION["demaquinas"] . "," .
		" dehmmaquinas = " . $_SESSION["dehmmaquinas"] . "," .
		" denturnos = " . $_SESSION["denturnos"] . "," .
		" deHoraExtra = " . $_SESSION["deHoraExtra"] . "," .
		" dePD = " . $_SESSION["dePD"] . "," .
		" depreco = " . $_SESSION["depreco"] . "," .
		" dedesconto = " . $_SESSION["dedesconto"] . "," .
		" deprazo = " . $_SESSION["deprazo"] . "," .
		" depropaganda = " . $_SESSION["depropaganda"] . "," .
		" deelp = " . $_SESSION["deelp"] . "," .
		" deengenheiro = " . $_SESSION["deengenheiro"] . "," .
		" deadministrador = " . $_SESSION["deadministrador"] . "," .
		" desecretaria = " . $_SESSION["desecretaria"] . "," .
		" deestagiarios = " . $_SESSION["deestagiarios"] . "," .
		" devendedor = " . $_SESSION["devendedor"] . "," .
		" desalarioOperario = " . $_SESSION["desalarioOperario"] .
		" WHERE id_player = $idplayer AND id_room = $id AND round = $round";


	$db->query($q);
    }



    $db->close();


    simulador(0, $round, $idplayer, false);

    logXManager("Decisão salva!\n");
    return true;
}

function getProfileColor($r) {
    foreach ($GLOBALS['ratcolormap'] as $key => $value) {
	if ($key < 0 or $r < $key) {
	    return $value;
	}
    }
}

function getRoomStatus($db, $idroom, $idusr, $round) {

    $db->query("SELECT id FROM decisions WHERE id_player = $idusr AND id_room = $idroom AND round = $round");

    $row = $db->nextRow();

    if ($row) {
	$status = true;
    } else {
	$status = false;
    }


    return $status;
}

function viewPlayerRooms($idusr) {
    if (!inputValidation()) {
	return false;
    }
    if (!parser($idusr)) {
	logXManager($idusr . " é uma entrada inválida!\n");
	return false;
    }

    $db = new maniadb;
    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);

    $db->query("SELECT id_room FROM players WHERE id_player = $idusr ORDER BY id_room DESC");

    $n = 0;
    $v = array();
    $lastid = 0;

    while ($row = $db->nextRow()) {
	$v[$n] = $row['id_room'];
	$lastid = $row['id_room'];
	++$n;
    }

    if ($n >= 10) {
	//    $db->query("DELETE FROM players WHERE id_player = $idusr AND id_room < $lastid");
    }


    for ($i = 0; $i < $n; ++$i) {
	$db->query("SELECT * FROM rooms WHERE id = " . $v[$i]);
	$row = $db->nextRow();

	$_SESSION['RoomName'] = $row['name'];
	$_SESSION['RoomId'] = $row['id'];
	$_SESSION['CurrRound'] = $row['current_round'];
	$_SESSION['RoundDuration'] = $row['round_duration'];
	$_SESSION['TimeInit'] = $row['time_init'];
	$_SESSION['TimeEnd'] = $row['time_init'] + ($row['current_round'] + 1) * $row['round_duration'];
	$_SESSION['nSlots'] = $row['slots'];
	$_SESSION['weight'] = $row['weight'];
	$_SESSION['nRounds'] = $row['nrounds'];

	$initTime = intval($_SESSION['TimeInit']);
	$roundDuration = intval($_SESSION['RoundDuration']);
	$TimeEnd = intval($_SESSION['TimeEnd']);

	$time = time();
	$roundt = intval(($time - $initTime) / $roundDuration);

	if ($roundt <= 0) {
	    $roundt = 0;
	}

	if ($roundt > $_SESSION['nRounds']) {
	    $roundt = $_SESSION['nRounds'] + 1;
	}

	$db->query("UPDATE rooms SET current_round = $roundt WHERE id = " . $v[$i]);
	$db->query("SELECT * FROM rooms WHERE id = " . $v[$i]);
	$row = $db->nextRow();

	echo '<tr><th class="profileData">';
	echo ' <a href="index.php?f=VerSala' .
	'&RoomId=' . $row['id'] . '"> Sala ' . $row['name'] . ' </a></th>';
	echo "<th class=\"profileData02\" >" . ($row['current_round']) . "</th>";
	if (getRoomStatus($db, $row['id'], $idusr, $row['current_round'])) {
	    echo "<th class=\"profileDataO\" > Ok";
	} else if ($roundt >= $_SESSION['nRounds']) {
	    echo "<th class=\"profileDataY\" > Sala encerrada";
	} else {
	    echo "<th class=\"profileDataX\" > Decisão não enviada";
	}
	echo "</th>";

	$db->query("SELECT pontuation FROM `Ranking sala` WHERE id_room = " . $v[$i] . " AND id_player = $idusr AND round = " .
		($roundt - 1));

	$row = $db->nextRow();
	if (!$row) {
	    $row = array('pontuation' => 0);
	}

	echo "<th class=\"profileData02\" >";
	printf("$ %.2lf", $row['pontuation']);
	echo "</th>";
	echo "</tr>";
    }

    $db->close();
    return true;
}

function viewRooms() {
    $n = 0;
    $ok = false;
    $db = new maniadb;
    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);

    $db->query("SELECT * FROM rooms WHERE slots > 0");
    while ($row = $db->nextRow()) {

	$initTime = intval($row['time_init']);
	$roundDuration = intval($row['round_duration']);
	$TimeEnd = intval($row['time_init'] +
		$row['nrounds'] * $row['round_duration']);

	$time = time();
	$round = intval(($time - $initTime) / $roundDuration);

	if ($round <= 0) {
	    $round = 0;
	}

	if ($round > 0) {
	    $db->queryNoBatch("UPDATE rooms SET slots = 0 WHERE id = " . $row['id']);
	    continue;
	}

	echo '<tr class="TabelaRodadaLinha">';
	echo '<th> <a href="index.php?f=VerSala' .
	'&RoomId=' . $row['id'] . '"> Sala ' . $row['name'] . '</a></th>';
	echo '<th>' . $row['slots'] . '</th>';
	echo '<th>';
	if ($row['status'] == 1) {
	    echo '<b> Aberta </b>';
	} else {
	    echo "<b> Fechada </b>";
	}
	'</th>';
	echo '<th>' . $row['current_round'] . '</th>';
	echo '<th>' . $row['nrounds'] . '</th>';
	echo '<th>' . $row['weight'] . '</th>';
	echo '<th>' . date('d/m/Y H:i:s', $row['time_init']) . '</th>';
	echo '<th>';
	print_date($row['round_duration']);
	echo '</th>';
	echo '<th>' . date('d/m/Y H:i:s', $row['time_init'] +
		$row['nrounds'] * $row['round_duration']) . '</th>';

	if ($row['slots'] > 0) {
	    $ok = true;
	}
	++$n;
	echo '</tr>';
    }

    $db->close();

    if (!$ok) {
	return 0;
    }

    return $n;
}

function createRoom($name) {
    if (!inputValidation()) {
	return false;
    }

    if (!parser($name)) {
	logXManager($name . " é uma entrada inválida!\n");
	return false;
    }

    $db = new maniadb;
    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);

    $db->query("SELECT id FROM rooms WHERE name = '$name'");
    if ($db->nextRow()) {
	echo "Sala <b>$name</b> já existe! <p>";
    } else {
	$nslots = $GLOBALS['myroomnslots'];
	$nrounds = $_POST["RoomDuraRo"]; //$GLOBALS['myroomnrounds'];
	$weight = $GLOBALS['myroomweight'];
	$id_owner = $_SESSION["usrid"];
	$tipocenario = $_POST['RoomTipo'];

	if ($tipocenario > $GLOBALS['NumCenarios']) {
	    $tipocenario = $GLOBALS['NumCenarios'];
	}

	if ($tipocenario < 1) {
	    $tipocenario = 1;
	}

	if ($_SESSION["usrpriv"] > 0) {
	    $round_duration = $_POST["RoomDuraSco"]; //$GLOBALS['myroomroundduration'];
	    $nslots = $_POST["RoomNSLOTS"];
	    $weight = $_POST['RoomWeight'];
	} else {
	    $round_duration = $GLOBALS['myroomroundduration'];
	}

	$db->query(
		"INSERT INTO rooms(name, slots, status, nrounds, weight, id_owner, time_init, round_duration, seed, `Tipo cenario`) " .
		"VALUES('$name', $nslots, 1, $nrounds, $weight, $id_owner, " . time() . ", $round_duration, " . time() . ", $tipocenario)");
    }
    $db->close();

    return true;
}

function viewGlobalRanking() {
    include_once("globalRankingViewForm.php");
}

?>
