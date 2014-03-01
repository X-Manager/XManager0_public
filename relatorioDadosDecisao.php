<table>
<tr>
<th>

<table border="0" style="color: #000; font-size: 12px; font-family: Georgia, 'Times New Roman', Times, serif;">

      
      <tr>
        <th colspan="2">&nbsp;</th>
      </tr>

      <tr>
        <th width="55%" class="RelatorioField">Quantidade    produzida</th>
        <th width="45%" bgcolor="#FFC" class="RelatorioValue">
<?php printf("%s", $GLOBALS['Dados para tomada de decisao']['Quantidade produzida']); ?>
</th>
      </tr>
      <tr>
        <th class="RelatorioField">Quantidade    vendida</th>
        <th bgcolor="#FFC" class="RelatorioValue">
<?php printf("%s", $GLOBALS['Dados para tomada de decisao']['Quantidade vendida']); ?>
</th>
      </tr>
      <tr>
        <th height="41" class="RelatorioField">Interesses    não atendidos</th>
        <th bgcolor="#FFC" class="RelatorioValue">
<?php printf("%s", $GLOBALS['Dados para tomada de decisao']['Interesses nao atendidos']); ?>
</th>
      </tr>
      <tr>
        <th class="RelatorioField">Estoque    inicial de produtos acabados</th>
        <th bgcolor="#FFC" class="RelatorioValue">
<?php printf("%s", $GLOBALS['Dados para tomada de decisao']['Estoque inicial de produtos acabados']); ?>
</th>
      </tr>
      <tr>
        <th class="RelatorioField">Estoque    final de produtos acabados</th>
        <th bgcolor="#FFC" class="RelatorioValue">
<?php printf("%s", $GLOBALS['Dados para tomada de decisao']['Estoque final de produtos acabados']); ?>


</th>
      </tr>
      <tr>
        <th class="RelatorioField">Matéria    prima disponível</th>
        <th bgcolor="#FFC" class="RelatorioValue">
<?php printf("%s", $GLOBALS['Dados para tomada de decisao']['Materia prima disponivel']); ?>

</th>
      </tr>
      <tr>
        <th class="RelatorioField">Máquinas    disponíveis</th>
        <th bgcolor="#FFC" class="RelatorioValue">
<?php printf("%s", $GLOBALS['Dados para tomada de decisao']['Maquinas disponiveis']); ?>

</th>
      </tr>
      <tr>
        <th class="RelatorioField">Eficiencia    das máquinas</th>
        <th bgcolor="#FFC" class="RelatorioValue">
<?php printf("%s%%", $GLOBALS['Dados para tomada de decisao']['Eficiencia das maquinas']); ?>

</th>
      </tr>

    <tr>
        <th class="RelatorioField">Eficiencia    dos operários</th>
        <th bgcolor="#FFC" class="RelatorioValue">
        <?php printf("%s%%", $GLOBALS['Dados para tomada de decisao']['Eficiencia dos operarios']); ?>

        </th>
    </tr>

    <tr>
        <th class="RelatorioField">Salário    dos operários</th>
        <th bgcolor="#FFC" class="RelatorioValue">
        <?php printf("%s", $GLOBALS['Dados para tomada de decisao']['Salario dos operarios']); ?>

        </th>
    </tr>


</table>
</th>

<th>
<table border="0" style="color: #000; font-size: 12px; font-family: Georgia, 'Times New Roman', Times, serif;">
   <tr> <th colspan="2" class="decisionFormTitle">  Decisão tomada</th> </tr>
<?php

    $rodada=$_SESSION['CurrRound']-1;
    
    foreach ($_GET as $key => $value) {
        $$key = $value;
    }

    foreach ($_POST as $key => $value) {
        $$key = $value;
    }    

    if (array_key_exists('CurrRound', $_SESSION)) {
        $currRound = $_SESSION['CurrRound'];
    }

    $currRound = $rodada;
    
    $db = new maniadb;
	$db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
	$db->select($GLOBALS['mydb']);
	
	$idroom = $_SESSION['RoomId'];    
	$idplayer = $_SESSION['usrid'];

    if ($currRound < 0) {
        $loid = -$_SESSION['Tipo cenario'];
        $db->query("SELECT * FROM decisions WHERE id_player = $loid AND id_room = $loid AND round = $loid"); 
    } else {
        $db->query("SELECT * FROM decisions WHERE id_player = $idplayer AND id_room = $idroom AND round = $currRound");
    }

	$row = $db->nextRow();
	if ($row) {
        for ($i = 0; $i < $GLOBALS['NDecisionFields']; ++$i) {
                echo '<tr>';            
                echo '<th class="decisionFormNames">'.$GLOBALS['DecisionNames'][$i].'</th>';

                $key  = $GLOBALS['DecisionFields'][$i];

                switch ($key) {
                    case 'deengenheiro': case 'deadministrador': case	'desecretaria':  case	'devendedor':
                        $k = intval($row[$key]);
                        $c = '?';
                        switch($k){
                            case 0: $c = 'A'; break; case 1: $c = 'B'; break; case 2: $c = 'C'; break;
                        }
                       
                        echo '<th align="center" class="decisionFormFields">'.$c.'</th>';
                    break;

                    default:
                        echo '<th align="center" class="decisionFormFields">'.(number_format($row[$key], 0, ',', '.')).'</th>';
                    break;
                }
                echo '</tr>';
        }
    }
    $db->close();
    
?>
    </table>    

</th>
</tr>
</table>

