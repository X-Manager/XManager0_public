<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.decisionFormNames {
    border: 1px solid #777;
	font-weight: bold;
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
    background-color: #B3B3B3;
    font-family: Georgia, "Times New Roman", Times, serif;
	color: #00000F;
	
}

.RelatorioField2 {
     border: 1px solid #777;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #FFF;
	background-color: #5F9EFF;
	font-size: 14px;
	text-align: center;
}


</style>
</head>

<?php
include_once("config.php");
include_once("maniadb.php");

updateInfo();

?>

<body>
        
<table width="95%" border="0" align="center">



<tr>
    
  

    <th valign="top" align="center" width="20%"><table >
        <tr> <th colspan="2" class="decisionFormTitle">  Parâmetros da sala</th> </tr>
<?php
        foreach ($GLOBALS['ParametrosJogo'] as $key => $value) {
            echo '<tr>';            
            echo '<th class="decisionFormNames">'.$value.'</th>';
            echo '<th align="center" class="decisionFormFields">'.(number_format($GLOBALS[$key], 2, ',', '.')).'</th>';
            echo '</tr>';
        }

        echo '<tr><th class="decisionFormNames">Matéria prima necessária para a produção de um produto acabado</th>';
        echo '<th align="center" class="decisionFormFields">'.$GLOBALS['MPNecessaria'] .'</th></tr>';
?>

    </table>    
    </th>
    
    <th valign="top" align="center" width="20%"><table >
        <tr> <th colspan="2" class="decisionFormTitle">  Salários</th> </tr>
<?php
        foreach ($GLOBALS['ParametrosJogoSalario'] as $key => $value) {
            echo '<tr>';            
            echo '<th class="decisionFormNames">'.$value.'</th>';
            echo '<th align="center" class="decisionFormFields">'.(number_format($GLOBALS[$key], 2, ',', '.')).'</th>';
            echo '</tr>';
        }
?>
    </table>
    </th>


    <th valign="top" align="center" width="20%"><table >
        <tr> <th colspan="2" class="decisionFormTitle">  Taxas</th> </tr>
<?php
        foreach ($GLOBALS['ParametrosJogoTaxa'] as $key => $value) {
            echo '<tr>';            
            echo '<th class="decisionFormNames">'.$value.'</th>';
            echo '<th align="center" class="decisionFormFields">'.(number_format(100*$GLOBALS[$key], 2, ',', '.')).'%</th>';
            echo '</tr>';
        }
?>

    </table>
    </th>



 <th valign="top" align="center" width="20%"><table >
  

        <tr> <th colspan="2" class="decisionFormTitle">  Custos</th> </tr>
<?php
        foreach ($GLOBALS['ParametrosJogoCustos'] as $key => $value) {
            echo '<tr>';            
            echo '<th class="decisionFormNames">'.$value.'</th>';

            echo '<th align="center" class="decisionFormFields">'.(number_format($GLOBALS[$key], 2, ',', '.')).'</th>';
            echo '</tr>';
        }
?>

        <tr><th class="decisionFormTitle" colspan="2"> Sazonalidades <th></tr>
            <?php
                srand($_SESSION['RoomSeed']); 
                for ($r = -1; $r < $_SESSION['nRounds']; ++$r) {
                    echo '<tr><th class="decisionFormNames"> Período '.($r+1)."</th>";

                    if ($_SESSION['CurrRound'] != $r) {
                        echo '<th class="decisionFormFields">';
                    } else {
                        echo '<th class="RelatorioField2">';
                    }

                                      
                    $ruido = rand(-20, 20) / 100.0;
                    if ($r > 0) {
                        printf("%.0lf %%</th>", 100 * 1* (1 + $ruido));
                    } else {
                        printf("%.0lf %%</th>", 100 * 1);
                    }
                    echo '</tr>';
                }
            ?>
    </table>
    </th>
</tr>


</table>
  



</body>
</html>
