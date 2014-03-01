<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.TabelaRodadaTitulo {
     border: 1px solid #777;
	background-color: #003300;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #FFF;
	font-size: 12px;
}

.TabelaRodadaLinha {
	font-size: 12px;
     border: 1px solid #777;
	background-color: #FFC;
	color: #000000;
	text-align: center;
}

.TabelaRodadaLinha th {
     border: 1px solid #777;
}

.TabelaRodadaLinha td {
     border: 1px solid #777;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #000;
}

.TabelaRodadaLinha a {
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #FF0000;
	font-weight: bold;
}

.TabelaRodadaLinha a:hover {
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #00FF00;
	font-weight: bold;
}

</style>
</head>

<body>
<table width="858" border="0">
  <tr class="TabelaRodadaTitulo">
    <th scope="col">Nome</th>
    <th scope="col">N° Slots</th>
    <th scope="col">Tipo</th>
    <th scope="col">Rodada atual</th>
    <th scope="col">N° rodadas</th>
    <th scope="col">Peso</th>
    <th scope="col">Inicio</th>
    <th scope="col">Duração da rodada</th>
    <th scope="col">Fim</th>
  </tr>
  	<?php 
		
		include_once("rooms.php"); 
		
		updateConfig();

		$nr = viewRooms();
		
		echo '</table>';
		
		
		if ($nr == 0 || $_SESSION["usrpriv"] > 0) {
			include_once('createRoomForm.php');
		}

	?>
  
</body>
</html>
