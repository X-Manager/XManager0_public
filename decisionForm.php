<!DOCTYPE html PUBLIC "-//W3C//Dth XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Dth/xhtml1-transitional.dth">
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
?>

<body>

<table width="100%" height="100%" border="0" align="center" valign="top">
  <tr>

    <th valign="top">
        <table>
            <tr><th class="decisionFormTitle" colspan="2"> Sazonalidades <th></tr>
            <?php
                srand($_SESSION['RoomSeed']); 
                for ($r = -1; $r < $_SESSION['nRounds']; ++$r) {
                    echo '<tr><th class="decisionFormNames">'.($r+1)."</th>";

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

<form id="form7" name="form7" method="post" action="index.php" autocomplete="on">

    <th width="20%" height="100%" align="center" scope="col" valign="top"><table width="85%" border="0">
      
      <tr>
        <th colspan="2" class="decisionFormTitle" scope="col">Produção</th>
      </tr>
      <tr>
        <th class="decisionFormNames" >Compra    de materia prima (unidades)</th>
        <th align="center" class="decisionFormFields">
        
        <?php
        	$v = "";
            
            if (array_key_exists('demateriaPrima',$_SESSION)) {
            	$v = $_SESSION['demateriaPrima'];
            }
            
        	echo '<input name="demateriaPrima" type="number" id="demateriaPrima" value="'.
            $v.'" min="0" max="1000000" required="required"/>';
        ?>
          
        </th>
      </tr>
      <tr>
        <th class="decisionFormNames" >Compra/venda    de maquinas (unidades)</th>
        <th align="center" class="decisionFormFields">
        
        <?php
        	$v = "";
            
            if (array_key_exists('demaquinas',$_SESSION)) {
            	$v = $_SESSION['demaquinas'];
            }
            
        	echo '<input name="demaquinas" type="number" id="maquina" value="'.
            $v.'" min="-100000" max="100000" required="required"/>'
        ?>
        
        
        </th>
      </tr>
      <tr>
        <th class="decisionFormNames" >Horas de    manutenção por máquina</th>
        <th align="center" class="decisionFormFields">
        
        <?php
        	$v = "";
            
            if (array_key_exists('dehmmaquinas',$_SESSION)) {
            	$v = $_SESSION['dehmmaquinas'];
            }
            
        	echo '<input name="dehmmaquinas" type="number" id="dehmmaquinas" value="'.
            $v.'" min="0" max="1000" required="required"/>'
        ?>
        
        </th>
      </tr>
      <tr>
        <th class="decisionFormNames" >Turnos    utilizados</th>
        <th align="center" class="decisionFormFields">
        
        <?php
        	$v = 1;
            
            if (array_key_exists("denturnos",$_SESSION)) {
            	$v = $_SESSION["denturnos"];
            }
            
            echo '<select name="denturnos" id="denturnos" value="'.$v.'" required="required">';
            echo '<option value="'.$v.'">'.$v.'</option>';
            if ($v != 1){echo '<option value="1">1</option>';}
            if ($v != 2){echo '<option value="2">2</option>';}
            if ($v != 3){echo '<option value="3">3</option>';}
            echo '</select>'
        ?>
        
        </th>
      </tr>
      <tr>
        <th class="decisionFormNames" >Hora extra</th>
        <th align="center" class="decisionFormFields">
        <?php
        	$v = "";
            
            if (array_key_exists("deHoraExtra",$_SESSION)) {
            	$v = $_SESSION["deHoraExtra"];
            }
            
            echo '<select name="deHoraExtra" id="deHoraExtra" value="'.$v.'" required="required">';
            if ($v==0) {echo '<option value="0">NÃO</option>'; }
            else { echo '<option value="1">SIM</option>';}
            if ($v != 0){echo '<option value="0">NÃO</option>';}
            if ($v != 1){echo '<option value="1">SIM</option>';}
            echo '</select>'
        ?>
        </th>
      </tr>
      <tr>
        <th class="decisionFormNames" >P&amp;D (R$)</th>
        <th align="center" class="decisionFormFields">
        
         <?php
        	$v = "";
            
            if (array_key_exists('dePD',$_SESSION)) {
            	$v = $_SESSION['dePD'];
            }
            
        	echo '<input name="dePD" type="number" id="dePD" value="'.
            $v.'" min="0" max="10000000" required="required"/>'
        ?>
        </th>
      </tr>
    </table></th>
     <th width="20%" height="100%" align="center" scope="col" valign="top"><table width="85%" border="0">
      <tr>
        <th colspan="2" class="decisionFormTitle" scope="col">Marketing &amp; Financeiro</th>
      </tr>
      <tr>
        <th class="decisionFormNames" >Preço (R$)</th>
        <th align="center" class="decisionFormFields">
          <?php
        	$v = "";
            
            if (array_key_exists('depreco',$_SESSION)) {
            	$v = $_SESSION['depreco'];
            }
            
        	echo '<input name="depreco" type="number" id="depreco" value="'.
            $v.'" min="0" max="1000000" required="required"/>'
        ?>
        </th>
      </tr>
      <tr>
        <th class="decisionFormNames" >Desconto (%)</th>
        <th align="center" class="decisionFormFields">
         <?php
        	$v = "";
            
            if (array_key_exists('dedesconto',$_SESSION)) {
            	$v = $_SESSION['dedesconto'];
            }
            
        	echo '<input name="dedesconto" type="number" id="dedesconto" value="'.
            $v.'" min="0" max="100" required="required"/>'
        ?>
        
        </th>
      </tr>
      <tr>
        <th class="decisionFormNames" >Vendas a prazo (%)</th>
        <th align="center" class="decisionFormFields">
         <?php
        	$v = "";
            
            if (array_key_exists('deprazo',$_SESSION)) {
            	$v = $_SESSION['deprazo'];
            }
            
        	echo '<input name="deprazo" type="number" id="deprazo" value="'.
            $v.'" min="0" max="100" required="required"/>'
        ?>
        
        </th>
      </tr>
      <tr>
        <th class="decisionFormNames" >Propaganda (R$)</th>
        <th align="center" class="decisionFormFields">
        <?php
        	$v = "";
            
            if (array_key_exists('depropaganda',$_SESSION)) {
            	$v = $_SESSION['depropaganda'];
            }
            
        	echo '<input name="depropaganda" type="number" id="depropaganda" value="'.
            $v.'" min="0" max="10000000" required="required"/>'
        ?>
        </th>
      </tr>
      <tr>
        <th class="decisionFormNames" >Empréstimo de longo prazo (R$)</th>
        <th align="center" class="decisionFormFields">
          <?php
        	$v = "";
            
            if (array_key_exists('deelp',$_SESSION)) {
            	$v = $_SESSION['deelp'];
            }
            
        	echo '<input name="deelp" type="number" id="deelp" value="'.
            $v.'" min="0" max="10000000" required="required"/>'
        ?>
        </th>
      </tr>
    </table></th>
    <th width="20%" height="100%" align="center" scope="col" valign="top"><table width="85%" border="0">
      <tr>
        <th colspan="2" class="decisionFormTitle" scope="col">Recursos Humanos</th>
      </tr>
      <tr>
        <th class="decisionFormNames" >Engenheiro</th>
        <th align="center" class="decisionFormFields">
         <?php
        	$v = "";
            
            if (array_key_exists("deengenheiro",$_SESSION)) {
            	$v = $_SESSION["deengenheiro"];
            }
            
            echo '<select name="deengenheiro" id="deengenheiro" value="'.$v.'" required="required">';
            if ($v==0) {echo '<option value="0">A</option>'; }
            if ($v==1) {echo '<option value="1">B</option>'; }
            if ($v==2) {echo '<option value="2">C</option>'; }
            
            if ($v!=0) {echo '<option value="0">A</option>'; }
            if ($v!=1) {echo '<option value="1">B</option>'; }
            if ($v!=2) {echo '<option value="2">C</option>'; }
            
            echo '</select>'
        ?>
          </th>
      </tr>
      <tr>
        <th class="decisionFormNames" >Administrador</th>
        <th align="center" class="decisionFormFields">
        <?php
        	$v = "";
            
            if (array_key_exists("deadministrador",$_SESSION)) {
            	$v = $_SESSION["deadministrador"];
            }
            
            echo '<select name="deadministrador" id="deadministrador" value="'.$v.'" required="required">';
            if ($v==0) {echo '<option value="0">A</option>'; }
            if ($v==1) {echo '<option value="1">B</option>'; }
            if ($v==2) {echo '<option value="2">C</option>'; }
            
            if ($v!=0) {echo '<option value="0">A</option>'; }
            if ($v!=1) {echo '<option value="1">B</option>'; }
            if ($v!=2) {echo '<option value="2">C</option>'; }
            
            echo '</select>'
        ?>
        </th>
      </tr>
      <tr>
        <th class="decisionFormNames" >Secretária</th>
        <th align="center" class="decisionFormFields">
         <?php
        	$v = "";
            
            if (array_key_exists("desecretaria",$_SESSION)) {
            	$v = $_SESSION["desecretaria"];
            }
            
            echo '<select name="desecretaria" id="desecretaria" value="'.$v.'" required="required">';
            if ($v==0) {echo '<option value="0">A</option>'; }
            if ($v==1) {echo '<option value="1">B</option>'; }
            if ($v==2) {echo '<option value="2">C</option>'; }
            
            if ($v!=0) {echo '<option value="0">A</option>'; }
            if ($v!=1) {echo '<option value="1">B</option>'; }
            if ($v!=2) {echo '<option value="2">C</option>'; }
            
            echo '</select>'
        ?>
        </th>
      </tr>
      <tr>
        <th class="decisionFormNames" >Estagiário de engenharia</th>
        <th align="center" class="decisionFormFields">
        <?php
        	$v = 0;
            
            if (array_key_exists("deestagiarios",$_SESSION)) {
            	$v = $_SESSION["deestagiarios"];
            }
            
            echo '<select name="deestagiarios" id="deestagiarios" value="'.$v.'" required="required">';
            echo '<option value="'.$v.'">'.$v.'</option>';
            for ($i = 0; $i <= 5; ++$i) {
            	if ($i != $v) {
                	echo '<option value="'.$i.'">'.$i.'</option>';
                }

			}
            echo '</select>'
        ?>
        </th>
      </tr>
      <tr>
        <th class="decisionFormNames" >Vendedor</th>
        <th align="center" class="decisionFormFields">
        <?php
        	$v = "";
            
            if (array_key_exists("devendedor",$_SESSION)) {
            	$v = $_SESSION["devendedor"];
            }
            
            echo '<select name="devendedor" id="devendedor" value="'.$v.'" required="required">';
            if ($v==0) {echo '<option value="0">A</option>'; }
            if ($v==1) {echo '<option value="1">B</option>'; }
            
            if ($v!=0) {echo '<option value="0">A</option>'; }
            if ($v!=1) {echo '<option value="1">B</option>'; }
            
            echo '</select>'
        ?>
        </th>
      </tr>
      <tr>
        <th class="decisionFormNames" >Aumento salário dos operários (%)</th>
        <th align="center" class="decisionFormFields">
         <?php
        	$v = "";
            
            if (array_key_exists('desalarioOperario',$_SESSION)) {
            	$v = $_SESSION['desalarioOperario'];
            }
            
        	echo '<input name="desalarioOperario" type="number" id="desalarioOperario" value="'.
            $v.'" min="0" max="1000" required="required"/>'
        ?>
        </th>
      </tr>
      <tr>
        <th align="right" colspan="2">
        <input type="submit" name="salvarDecisao" id="salvarDecisao" value="Salvar Decisão" />
        <input type="hidden" name="f" value="SalvarSalaDecisao">
        </th>
      </tr>
    </table></th>

</form>

    <th  width="45%" align="center">
        <table width="100%" align="center">
            <tr><th align="center" class="decisionFormTitle">  Decisões passadas</th></tr>
            <tr><th> <iframe src="viewCharts.php?tipo=decisions" width="100%" height="400" valign="top" margin="0" border="0"> </iframe> </th></tr>
        </table>
    </th>


</tr>
<th class="decisionFormNames"  colspan="4">  
              - Simuladores empresariais são complexos, para entendê-los é de suma importância dar pelo menos uma lida no  <a href="http://xmanager.co/index.php?f=Home&g=Manual"> MANUAL </a>; <p>
			  - Você pode enviar quantas decisões desejar, dentro do tempo limite para a rodada atual;<p>
			  - Se você não mandar a decisão antes que acabe o tempo limite para cada rodada, você será elimidado da competição;<p>
			  - Os resultados de suas decisões estarão disponíveis após o termino do tempo da rodada atual na aba "Relatórios";<p>
			  - Use a aba "simulador" após o envio da decisão, assim você saberá se ela é viável ou não;<p>
			  - Acesse o <a href="http://www.facebook.com/groups/xmanager/"> grupo de discussões do X-Manager no facebook </a>, lá você encontra outros participantes e notícias sobre o simulador.
     </th>
</tr>

</table>





</body>
</html>
