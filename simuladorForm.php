<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.decisionFormNames {
	font-weight: bold;
    border: 1px solid #777;
	background-color: #5A5A5A;
	color: #FFFFFF;
    font-size: 12px;
	font-family: Georgia, "Times New Roman", Times, serif;
}
.decisionFormFields {
    border: 1px solid #777;
    
	font-family: Georgia, "Times New Roman", Times, serif;
    color: #000000;
    font-size: 12px;
	background-color: #FFC;
}

.decisionFormTitle {
    border: 1px solid #777;
    
	color: #FFFF00;
	background-color: #5489E1;
}

.tituloRelatorio {
	color: #FC0;
    border: 1px solid #777;
    
	text-align: center;
	font-size: 12px;
	font-family: Georgia, "Times New Roman", Times, serif;
}


.tituloRelatorio:hover{
	color: #FC0;
    border: 1px solid #777;
    
    background-color: #191970;
	text-align: center;
	font-size: 12px;
	font-family: Georgia, "Times New Roman", Times, serif;
}


.RelatorioField {
    border: 1px solid #777;
    
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #FFF;
    background-color: #5A5A5A;
	
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

    include_once("simulador.php");
    $ropt = 'none';


    $Venda_Estimada = 100;

    foreach ($_SESSION as $key => $value) {
        $$key = $value;
    }


    foreach ($_POST as $key => $value) {
        $$key = $value;
    }

    foreach ($_GET as $key => $value) {
        $$key = $value;
    }


	$idplayer = $_SESSION['usrid'];
    $initTime = intval($_SESSION['TimeInit']);
    $roundDuration = intval($_SESSION['RoundDuration']);
    $TimeEnd = intval($_SESSION['TimeEnd']);

    $time = time();
    $round = intval(($time - $initTime)/$roundDuration);
	if ($round <= 0) {
		$round = 0;
	}

    if (!simulador($Venda_Estimada, $round, $idplayer, true)) {
        logXManager("É preciso tomar uma decisão antes!\n");
    } else {
        changeNumberFormat(); 
    }

?>

<form id="form1" name="form1" method="post" action="index.php">
<table border="0">
<tr>
    <th class="RelatorioField">Venda estimada(%):</th>
    <th align="left" valign="top" scope="col" class="RelatorioValue">
<?php
        echo '<input name="Venda_Estimada" type="number" id="Venda_Estimada" '. 
                'value="'.$Venda_Estimada.'" min="0" max="100" required="required"/>';
?>
        
    </th>
    <th>
        <input type="hidden" name="f" value="VerSimulador">
        <input type="submit" value="Simular">
    </th>
  </tr>
</table>
</form>

<table width="100%" border="0">
<tr>

<?php
if (strcmp($ropt,"relDados") != 0) {
    echo '<th height="55"  bgcolor="#333333" width="25%" align="center" valign="center" scope="col" class="tituloRelatorio">'.
    '<a href="index.php?f=VerSimulador&ropt=relDados&Venda_Estimada='.$Venda_Estimada.'">'. 
    'Dados para tomada de decisão'.
    '</a>';
    echo '</th>';
} else {
    echo '<th height="55" bgcolor="#000080" width="25%" class="tituloRelatorio" scope="col">Dados para tomada de decisão</th>';
}

if (strcmp($ropt,"demRes") != 0) {
    echo '<th height="55"  bgcolor="#333333" width="25%" align="center" valign="center" scope="col" class="tituloRelatorio">'.
    '<a href="index.php?f=VerSimulador&ropt=demRes&Venda_Estimada='.$Venda_Estimada.'">'. 
    'Demonstrativo de resultados'.
    '</a>';
    echo '</th>';
} else {
    echo '<th height="55" bgcolor="#000080" width="25%" class="tituloRelatorio" scope="col">Demostrativo de resultados</th>';
}

if (strcmp($ropt,"fluxCaixa") != 0) {
    echo '<th height="55"  bgcolor="#333333" width="25%" align="center" valign="center" scope="col" class="tituloRelatorio">'.
    '<a href="index.php?f=VerSimulador&ropt=fluxCaixa&Venda_Estimada='.$Venda_Estimada.'">'. 
    'Fluxo de Caixa'.
    '</a>';
    echo '</th>';
} else {
    echo '<th height="55" bgcolor="#000080" width="25%" class="tituloRelatorio" scope="col">Fluxo de Caixa</th>';
}


if (strcmp($ropt,"balanco") != 0) {
    echo '<th height="55"  bgcolor="#333333" width="25%" align="center" valign="center" scope="col" class="tituloRelatorio">'.
    '<a href="index.php?f=VerSimulador&ropt=balanco&Venda_Estimada='.$Venda_Estimada.'">'. 
    'Balanço'.
    '</a>';
    echo '</th>';
} else {
    echo '<th height="55" bgcolor="#000080" width="25%" class="tituloRelatorio" scope="col">Balanço</th>';
}
?>
    
</tr>

<tr>
<th  colspan="1" scope="col" valign="top" align="center">
<?php
    $okGraph = false;
    switch($ropt) {
        case 'relDados':
            $okGraph = true;
            include_once('relatorioDadosDecisao.php');
        break;

        case 'demRes':
            $okGraph = true;            
            include_once('relatorioDemostrativoResultados.php');
        break;

        case 'fluxCaixa':
            $okGraph = true;            
            include_once('relatorioFluxoCaixa.php');
        break;

        case 'balanco':
            $okGraph = true;
            include_once('relatorioBalanco.php');
        break;
    }
?>
</th>

<th colspan="3" scope="col" valign="top" align="center">
<?php
if ($okGraph) {
    echo '<iframe src="viewCharts.php?tipo='.$ropt.'" width="95%" height="450" valign="top">';

    echo '</iframe>';
}
?>
</th>

</tr>

</table>
</body>
</html>
