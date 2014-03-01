<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
	<style type="text/css">


	    .rating1 {
		border: 1px solid #777;    
		font-weight: bold;
		font-family: Georgia, "Times New Roman", Times, serif;
		color: #BEBEBE;
		background-color: #FFC;
	    }

	    .rating2 {
		border: 1px solid #777;
		font-weight: bold;
		font-family: Georgia, "Times New Roman", Times, serif;
		color: #00FF00;
		background-color: #FFC;
	    }

	    .rating3 {
		border: 1px solid #777;
		font-weight: bold;
		font-family: Georgia, "Times New Roman", Times, serif;
		color: #0000FF;
		background-color: #FFC;
	    }

	    .rating4 {
		border: 1px solid #777;
		font-weight: bold;
		font-family: Georgia, "Times New Roman", Times, serif;
		color: #FFA500;/*#FFFF00;*/
		background-color: #FFC;
	    }

	    .rating5 {
		border: 1px solid #777;
		font-weight: bold;
		font-family: Georgia, "Times New Roman", Times, serif;
		color: #FF0000;
		background-color: #FFC;
	    }

	    .TabelaRodadaTitulo {
		background-color: #003300;
		font-family: Georgia, "Times New Roman", Times, serif;
		color: #FFF;
		font-size: 12px;
	    }

	    .TabelaRodadaLinha {
		font-size: 12px;
		background-color: #FFC;
		color: #000000;
		text-align: center;
	    }

	    .TabelaRodadaLinha td {
		font-family: Georgia, "Times New Roman", Times, serif;
		color: #000;
	    }

	    .TabelaRodadaLinha  {
		border: 1px solid #777;
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
		<th scope="col" witdh="60">Posição</th> 
		<th scope="col">Nome</th>
		<th scope="col">Capital</th>
		<th scope="col">ELO</th>
	    </tr>
	    <?php
	    include_once("rooms.php");
	    $db = new maniadb;
	    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
	    $db->select($GLOBALS['mydb']);

	    $db->query("SELECT value FROM `Configuracao` WHERE id = 1");
	    $row = $db->nextRow();
	    $ns = $row['value'] + 50;
	    $db->query("SELECT id, name, capital, rating FROM `users` ORDER BY `rating` DESC LIMIT 0, $ns");
	    $n = 1;

	    while ($row = $db->nextRow() and $n <= 50) {
		if ($row['id'] < 0) {
		    continue;
		}

		$name = $row['name'];
		$capital = $row['capital'];
		$rating = $row['rating'] + 1200;
		$rcolor = getProfileColor($rating);

		echo "<tr>";

		echo "<th class=\"TabelaRodadaLinha\">$n</th>";
		$n++;

		echo "<th class=\"$rcolor\"> $name </th>";

		echo "<th class=\"TabelaRodadaLinha\">";
		printf("$ %.2lf", $capital);
		echo "</th>";

		echo "<th class=\"TabelaRodadaLinha\">";
		printf("%.0lf", $rating);
		echo "</th>";


		echo "</tr>";
	    }


	    $db->close();
	    ?>

	</table>

    </body>
</html>

