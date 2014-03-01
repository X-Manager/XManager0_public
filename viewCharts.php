<?php session_start (); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<style type="text/css">
body{
margin: 0;
padding: 0;
width: 100%;
height: 100%;
}

.tituloRelatorio {
	color: #FC0;
	text-align: center;
	font-size: 12px;
    border: 1px solid #777;
    
	font-family: Georgia, "Times New Roman", Times, serif;
}
.RelatorioField {
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #FFF;
	border: 1px solid #777;
    background-color: #B3B3B3;

	font-size: 12px;
	text-align: left;
}
.RelatorioValue {
	color: #000;
    border: 1px solid #777;
    
	text-align: center;
	font-size: 12px;
	font-weight: bold;
	font-family: Georgia, "Times New Roman", Times, serif;
	background-color: #FFC;
}
.RelatorioTitle {
	color: #F00;
    border: 1px solid #777;
    
	text-align: center;
	font-size: 14px;
	font-family: Georgia, "Times New Roman", Times, serif;
}
.RelatorioValueFinal {
    border: 1px solid #777;
    
	color: #000;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 12px;
}
.RelatorioFieldSubtitle {
    border: 1px solid #777;
    
	color: #000;
	font-weight: bold;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 12px;
}

relatorio {
    border: 1px solid #777;
    
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 12px;
	color: #000;
}
#form1 label {
	color: #FF0;
}
</style>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<?php
    include_once ("config.php");
    include_once ("maniadb.php");

   
    $tipo = "";
    $relatorio = "";
    $campo = "";
    $funcao = "";

    if (array_key_exists('tipo',$_GET)) {
        $tipo = $_GET['tipo'];
    }


    $idplayer = $_SESSION['usrid'];
    $idroom = $_SESSION['RoomId'];
    $round = $_SESSION['CurrRound'];

    if (array_key_exists('campo',$_POST)) {
        $campo = $_POST['campo'];
    }

    if (array_key_exists('f',$_POST)) {
        $funcao = $_POST['f'];
    }

    if (array_key_exists('tipo',$_POST)) {
        $tipo = $_POST['tipo'];
    }

    switch ($tipo) {
        case 'relDados':
            $relatorio = 'Dados para tomada de decisao';
        break;

        case 'demRes':            
            $relatorio = 'Demonstrativo de Resultados';
        break;

        case 'fluxCaixa':            
            $relatorio = 'Fluxo de caixa';
        break;

        case 'balanco':
            $relatorio = 'Balanco';
        break;

        case 'decisions':
            $relatorio = 'decisions';
        break;

    }

    $db = new maniadb;
    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);

    $data = array();
    if (strcmp($relatorio,"") != 0) {
        
        $loid = -(($idroom % $GLOBALS['NumCenarios']) +1);

        $query = "SELECT * FROM `$relatorio` WHERE id_player = $loid AND id_room = $loid LIMIT 0 , 1";
        $db->query($query);

        $dbv = array();

        $row = $db->nextRow();
        if ($row) {
            foreach ($row as $key => $value){
                $dbv[$key] = $value;
                $data['-1'][$key] = $value; 
            }
        }
    }

    if (strcmp($campo,"") != 0) {
        $query = "SELECT `$campo`, `round` FROM `$relatorio` WHERE id_player = $idplayer AND id_room = $idroom AND round < $round ORDER BY round ASC";
        $db->query($query);

        $fields = array('Rodada', $campo);

        $t = array();
        $n = 0;
        while ($row = $db->nextRow()) {
            $data[$row['round']][$campo] = $row[$campo];
            $t[$n] = $row['round'];             
            ++$n;
        }

        $datas = "[\n";

        $campoName = $campo;

        if (strcmp($relatorio, "decisions") == 0) {
            $campoName = $GLOBALS['DecisionMap'][$campo];
        }

        $datas .=  "['Rodada' , '$campoName']\n";
        $datas .= ",['".'0'."' , ".$data['-1'][$campo]."]\n";

        for ($i = 0; $i < $n; ++$i) {
            $datas .= ",['".($t[$i]+1)."' , ".$data[$t[$i]][$campo]."]\n";
        }
        $datas .="]\n";

        echo '<script type="text/javascript">';

        echo 'google.load("visualization", "1", {packages:["corechart"]});';
        echo 'google.setOnLoadCallback(drawChart);';
        echo 'function drawChart() {';
        echo 'var data = google.visualization.arrayToDataTable('.$datas.');';
        echo  'var options = {';
        echo      "title: '$campoName'";
        echo   '  };';

        echo    " var chart = new google.visualization.LineChart(document.getElementById('chart_div'));";
        echo     "chart.draw(data, options);";
        echo   "}";
        echo "</script>";
    }

    $db->close();

?>



</head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> X-Manager</title>

<body>

<?php
if (strcmp($relatorio,"") != 0) {
?>
<table border="0" width = "100%" margin="0">
    <form method="post"  action="viewCharts.php">
        <tr>
            <th class="RelatorioField" width = "10%">Campo : </th>

             <th class="RelatorioValue" width = "50%" align="left">
                    <?php


                        $campoName = $campo;
                        if (strcmp($relatorio, "decisions") == 0 and strcmp($campo, "") != 0) {
                            $campoName = $GLOBALS['DecisionMap'][$campo];
                        }

                        echo '<select name="campo" id="campo" value="'.$campo.'">';
                        echo '<option value="'.$campo.'">'.$campoName."</option>";

                        foreach ($dbv as $key => $value) {
                            switch ($key) {
                                case "id":	case "id_player":	
                                case "id_room":	case "round":	case "time": break;
                                default:
                                    $campoName = $key;
                                    if (strcmp($relatorio, "decisions") == 0) {
                                        $campoName = $GLOBALS['DecisionMap'][$key];
                                    } 
                                    echo '<option value="'.$key.'">'.$campoName."</option>"; 
                                break;
                            }
                        }
                    ?>
                </select>        
            </th>
            
            <th class="RelatorioValue"  width="10%" align="left">
                <?php
                    echo '<input type="hidden" name="tipo" value="'.$tipo.'">';
                ?>
                <input type="hidden" name="f" value="gerarGrafico">
                <input type="submit" value="Plotar">
            </th>
        </tr>
        
    </form>
</table>

<table border="0" width = "100%" height="350px">
    <tr>
        <th width="100%" height="100%">
        <div id="chart_div"  style=" height: 350px; "></div>
        </th>
    </tr>
</table>

<?php
}
?>



</body>



</html>

