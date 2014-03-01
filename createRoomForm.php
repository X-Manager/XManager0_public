<style type="text/css">
    .CriaSalaTitulo {
	color: #FFC;
	background-color: #000;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 12px;
    }
    .CriarSalaCorpo {
	text-align: center;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #000;
	font-size: 12px;
	font-weight: bold;
	background-color: #333;
    }
    .CriarSalaCorpo {
	font-weight: bold;
	color: #FFF;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 12px;
    }
</style>
<body>
    <form name="form1" method="post" action="index.php">

	<table width="280" border="0">
	    <tr>
		<th colspan="12" class="CriaSalaTitulo" scope="col">Dê o nome da nova sala</th>
	    </tr>
	    <tr>
		<td width="70" bgcolor="#FFFFCC" class="CriarSalaCorpo">Nome </td>
		<td width="180" bgcolor="#333333"><input name="RoomName" type="text" id="RoomName" size="40" maxlength="40"></td>

		<?php if ($_SESSION["usrpriv"] > 0) { ?>
    		<td width="70" bgcolor="#FFFFCC" class="CriarSalaCorpo">Duração </td>
    		<td width="140" bgcolor="#333333"> <input name="RoomDuraSco" type="number" id="RoomDuraSco" value="3600" min="300" max="10000000" required="required"/></td>


    		<td width="70" bgcolor="#FFFFCC" class="CriarSalaCorpo">No slots </td>
    		<td width="140" bgcolor="#333333"> <input name="RoomNSLOTS" type="number" id="RoomNSLOTS" value="10" min="2" max="10000000" required="required"/></td>


    		<td width="70" bgcolor="#FFFFCC" class="CriarSalaCorpo">Peso </td>
    		<td width="140" bgcolor="#333333"> <input name="RoomWeight" type="number" id="RoomWeight" value="10" min="2" max="10000000" required="required"/></td>


		<?php } ?>

		<td width="70" bgcolor="#FFFFCC" class="CriarSalaCorpo">No rodadas </td>
		<td width="140" bgcolor="#333333"> <input name="RoomDuraRo" type="number" id="RoomDuraRo" value="4" min="4" max="10000" required="required"/></td>


		<td width="70" bgcolor="#FFFFCC" class="CriarSalaCorpo">Tipo cenario </td>
		<?php
		echo '<td width="140" bgcolor="#333333"> <input name="RoomTipo" type="number" id="RoomTipo" value="4" min="1" max="' . $GLOBALS['NumCenarios'] . '" required="required"/></td>';
		?>

	    </tr>
	    <tr>
		<td colspan="12" bgcolor="#333333" class="CriarSalaCorpo">
		    <input type="hidden" name="f" value="CriarSala">
		    <input type="submit" name="Criar sala" id="Criar sala" value="Criar sala">
		</td>
	    </tr>
	</table>

    </form>
</body>
