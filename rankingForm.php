<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
	<style type="text/css">
	    .tituloRelatorio {
		border: 1px solid #777;
		color: #FC0;
		text-align: center;
		font-size: 12px;
		font-family: Georgia, "Times New Roman", Times, serif;
	    }


	    .tituloRelatorio:hover{
		color: #FC0;
		background-color: #191970;
		text-align: center;
		font-size: 12px;
		font-family: Georgia, "Times New Roman", Times, serif;
	    }

	    .RelatorioField2 {
		border: 1px solid #777;
		font-family: Georgia, "Times New Roman", Times, serif;
		color: #FFF;
		background-color: #5F9EFF;
		font-size: 14px;
		text-align: left;
	    }


	    .RelatorioField {
		border: 1px solid #777;
		font-family: Georgia, "Times New Roman", Times, serif;
		color: #FFF;
		background-color: #5F9EA0;
		font-size: 14px;
		text-align: left;
	    }
	    .RelatorioValue {
		border: 1px solid #777;
		color: #000;
		text-align: center;
		font-size: 14px;
		font-weight: bold;
		font-family: Georgia, "Times New Roman", Times, serif;
		background-color: #FFC;
	    }
	    .RelatorioTitle {
		border: 1px solid #777;
		color: #F00;
		text-align: center;
		font-size: 14px;
		font-family: Georgia, "Times New Roman", Times, serif;
	    }
	    .RelatorioValueFinal {
		border: 1px solid #777;
		color: #000;
		font-family: Georgia, "Times New Roman", Times, serif;
		font-size: 14px;
	    }
	    .RelatorioFieldSubtitle {
		border: 1px solid #777;
		color: #000;
		font-weight: bold;
		font-family: Georgia, "Times New Roman", Times, serif;
		font-size: 14px;
	    }
	    .RelatorioValueFinal {
		border: 1px solid #777;
		text-align: center;
	    }
	    relatorio {
		border: 1px solid #777;
		font-family: Georgia, "Times New Roman", Times, serif;
		font-size: 14px;
		color: #000;
	    }
	    #form1 label {
		color: #FF0;
	    }
	</style>
    </head>

    <body>
	<?php
	include_once("config.php");
	include_once("maniadb.php");
	include_once("ELO.php");

	if ($_SESSION['CurrRound'] == 0) {
	    $_SESSION['CurrRound'] = 0;
	    return;
	}

	setlocale(LC_ALL, "pt_BR.utf-8");
	$idplayer = $_SESSION["usrid"];
	$idroom = $_SESSION['RoomId'];
	$round = $_SESSION['CurrRound'] - 1;
	?>

	<table align = "center" valign="top" width = "60%">
	    <tr>
		<th width="50%" bgcolor="#000080" class="tituloRelatorio" scope="col">Empresa</th>
		<th width="50%" bgcolor="#000080" class="tituloRelatorio" scope="col"> Valor</th>
	    </tr>


	    <?php
	    $db = new maniadb;
	    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
	    $db->select($GLOBALS['mydb']);

	    $db2 = new maniadb;
	    $db2->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
	    $db2->select($GLOBALS['mydb']);

	    $db->query("SELECT `weight` FROM `rooms` WHERE id = $idroom");

	    $row = $db->nextRow();
	    $K = $row['weight'] / $_SESSION['nRounds'] + 5;

	    $ranking = array();
	    $capital = array();
	    $players = array();
	    $ca0 = array();
	    $ratings = array();

	    $okRat = true;

	    $db->query("SELECT MAX(round) FROM `Ranking sala` WHERE id_room = $idroom");
	    $mr = $db->nextRow();
	    $mr = $mr['MAX(round)'];
	    if ($round <= $mr and $mr != NULL) {
		$db->query("SELECT `id_player`, `pontuation` FROM `Ranking sala` WHERE id_room = $idroom AND round = $round ORDER BY `pontuation` DESC");
	    } else {
		$db->query("SELECT `id_player`, `pontuation` FROM `Ranking sala` WHERE id_room = $idroom AND round = $mr ORDER BY `pontuation` DESC");
		$okRat = false;
	    }

	    $n = 1;
	    while ($row = $db->nextRow()) {
		$capital[$n - 1] = 0.001 * $row['pontuation'];
		$players[$n - 1] = $row['id_player'];
		$idcp = $row['id_player'];

		$db2->query("SELECT `name` FROM `users` WHERE id = $idcp");
		$row2 = $db2->nextRow();
		$name = $row2['name']
		?>
    	    <tr>
		    <?php
		    if ($idplayer == $row['id_player']) {
			?>
			<th class="RelatorioField2"> 
			<?php } else {
			    ?>
			    <th class="RelatorioField">

			    <?php } ?>
			    <? echo $n . ":" . $name; ?>
    		    </th>

    		    <th bgcolor="#FFC" class="RelatorioValue"> 
			    <?php
			    $v = number_format($row['pontuation'], 2, ',', '.');
			    //if ($okRat) {
			    printf(" $ %s", $v);
			    //}
			    ?> 
    		    </th>

    	    </tr>
		<?php
		++$n;
	    }


	    $idplayer = $_SESSION["usrid"];
	    $idroom = $_SESSION['RoomId'];
	    $round = $_SESSION['CurrRound'] - 1;

	    $db->query("SELECT time FROM `Ranking sala` WHERE id_player = $idplayer AND id_room = $idroom AND round = $round");

	    $time = -1;

	    $row = $db->nextRow();

	    if ($row) {
		$time = $row['time'];
	    }

	    if ($time > 0 and $n - 1 > 1) {
		$db->query("UPDATE `Ranking sala` SET time = -1 WHERE id_room = $idroom AND round = $round");

		for ($i = 0; $i < $n - 1; ++$i) {
		    $p = $players[$i];
		    $db->query("SELECT `rating`, `capital` FROM `users` WHERE id = $p");
		    $row = $db->nextRow();

		    $ranking[$i] = $row['rating'];
		    $ca0[$i] = $row['capital'];
		}

		$ratings = ELO_novos_ratings($ranking, $n - 1, $K);

		for ($i = 0; $i < $n - 1; ++$i) {

		    $r0 = $ranking[$i];
		    $c0 = $ca0[$i];

		    $p = $players[$i];
		    $r = $ratings[$i];
		    $c = $capital[$i] + $c0;



		    $db->query("UPDATE `users` SET `rating` = '$r', `capital` = '$c' WHERE id = $p");
		}
	    }

	    $db->close();
	    $db2->close();
	    ?>


	</table>

    </body>
</html>
