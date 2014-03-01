<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.RoomViewStyle {
	color: #FFF;
	font-family: Georgia, "Times New Roman", Times, serif;
}
.RoomTitleStyle {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 16px;
	color: #FC3;
}
.RodadaTitleView {
	color: #FFF;
}
.RodadaCountView {
	color: #F00;
}
.RoomNameTitle {
	font-size: 32px;
}
.RoomTitleStyle .RodadaDataView {
	font-size: 10px;
	color: #FFF;
	font-weight: bold;
}
.fonteDefault {
	color: #000;
}

.RoomViewStyle th:hover{
    background-color: #191970;
    color: #00FF00;
}

</style>
</head>

<body>
<table width="100%" height="363" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <th height="47" bgcolor="#969696" class="RoomTitleStyle" scope="col"><p><span class="RoomNameTitle">
      
      <?php
        include_once("rooms.php");

        	echo $_SESSION['RoomName'];

        

        $_SESSION['CurrRound'] = getCurrRound($_SESSION['RoomId']);
        
        $initTime = intval($_SESSION['TimeInit']);
	    $roundDuration = intval($_SESSION['RoundDuration']);
	    $TimeEnd = intval($_SESSION['TimeEnd']);

	    $time = time();
	    $round = intval(($time - $initTime)/$roundDuration);

        $GLOBALS['isFinished'] = false;
        $GLOBALS['isEliminated'] = false;

        
        $id_player = $_SESSION["usrid"];

		if ($round <= 0) {
			$round = 0;
		}
        
        if ($round >= $_SESSION['nRounds']) {
            $round = $_SESSION['nRounds'] + 1;
        }

        
        if ($round > $_SESSION['CurrRound']) {
            $_SESSION['CurrRound'] = $round; 
        }
        
  
        if ($round >= $_SESSION['nRounds']) {
            $round = $_SESSION['nRounds'] + 1;            
            $GLOBALS['isFinished'] = true;
        }

        if (!$GLOBALS['isFinished']) {
            $okv = $GLOBALS['isEliminated'] = isEliminated($id_player, $round-1);
        }
    ?>
      
      </span><p> <span class="RodadaTitleView">Período:</span> <span class="RodadaCountView">
        
    <?php
        if (!$GLOBALS['isFinished'] and !$GLOBALS['isEliminated']) {
    	    echo $_SESSION['CurrRound'];
        } elseif ($GLOBALS['isFinished'])  {
            echo "Encerrada!";
        } elseif ($GLOBALS['isEliminated']) {
            echo "Eliminado!";
        } 
    ?> 
      </span></p>

    <?php
        if (!$GLOBALS['isFinished']) {
    ?>
      <p><span class="RodadaTitleView">Fim da Rodada:</span> <span class="RodadaCountView">
        <?php
        $timeEnd = date('d/m/Y H:i:s', intval($_SESSION['TimeEnd']));
    	echo $timeEnd;
    ?>
    </span></p>
    <?php
    }
    ?>
    </th>
  </tr>
  <tr>
    <td height="58" bgcolor="#666666"><table width="100%" height="51" border="0" cellpadding="0" cellspacing="0">
      <tr class="RoomViewStyle">

<?php
if (!$GLOBALS['isFinished'] and !$GLOBALS['isEliminated']) {
if ($_GLOBALS['isdecision']) {
?>
        <th bgcolor="#555555" width="20%" scope="col" style="color: #FC0;"> Decisão</th>

<?php
} else {
?>
        <th bgcolor="#000000" width="20%" scope="col"><a href="index.php?f=VerSalaDecisao"> Decisão</a></th>
<?php
}
?>

<?php
if ($_GLOBALS['issimulador']) {
?>
      <th bgcolor="#555555" width="20%" scope="col" style="color: #FC0;">Simulador </th>
<?php
} else {
?>
        <th bgcolor="#000000" width="20%" scope="col"><a href="index.php?f=VerSimulador">  Simulador </a></th>
<?php
}}
?>

<?php
if (!$GLOBALS['isEliminated'] ) {
if ($_GLOBALS['isrelatorio']) {
?>

<th bgcolor="#555555" width="20%" scope="col" style="color: #FC0;">Relatórios</th>
<?php
} else {
?>
         <th bgcolor="#000000" width="20%" scope="col"><a href="index.php?f=VerRelatorios">Relatórios</a></th>
<?php
}}
?>

<?php
if (!$GLOBALS['isEliminated'] ) {
if ($_GLOBALS['isinfo']) {
?>

    <th bgcolor="#555555" width="20%" scope="col" style="color: #FC0;">Informações</th>

<?php
} else {
?>
         <th bgcolor="#000000" width="20%" scope="col"><a href="index.php?f=VerInfo">Informações</a></th>
<?php
}}
?>

<?php
if ($_GLOBALS['isrank']) {
?>
        <th bgcolor="#555555" width="20%" scope="col" style="color: #FC0;">Ranking</th>

<?php
} else {
?>
       <th bgcolor="#000000" width="20%" scope="col"><a href="index.php?f=VerRanking">Ranking</a></th>

<?php
}
?>


      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="206"  color="#000"class="fonteDefault">
    <?php
    	if ($_GLOBALS['isdecision'] and !$GLOBALS['isFinished'] and !$GLOBALS['isEliminated'] ) {
        	include_once('decisionForm.php');
		} elseif ($_GLOBALS['isrelatorio'] and !$GLOBALS['isEliminated']) {
			include_once('relatorioForm.php');
		} elseif($_GLOBALS['issimulador'] and !$GLOBALS['isFinished'] and !$GLOBALS['isEliminated'] ) {
			include_once('simuladorForm.php');
		} elseif($_GLOBALS['isinfo']) {
            include_once('infoForm.php');
        } elseif ($_GLOBALS['isrank'] ) {
            include_once('rankingForm.php');
        }
    ?>
    </td>
  </tr>
</table>
</body>
</html>
