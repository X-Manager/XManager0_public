<?php
include_once('rooms.php');

$db = new maniadb;
$db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
$db->select($GLOBALS['mydb']);

$usrid = $_SESSION['usrid'];

$db->query("SELECT * FROM `users` WHERE id = $usrid");
$row = $db->nextRow();

$rvalue = $row['rating'] + 1200;
$rating = number_format(1200 + $row['rating'], 0, ',', '.'); 
$capital = "$ ".number_format($row['capital'], 2, ',', '.'); 

$rcolor = getProfileColor($rvalue);
$db->close();
?>


<!DOCTYPE html PUBLIC "-//W3C//Dth XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Dth/xhtml1-transitional.dth">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.profileView {
	text-align: center;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #FFF;
	background-color: #000;
}
.ProfileFields {
     border: 1px solid #777;
	font-weight: bold;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #FFFFFF;
	background-color: 	#3B3B3B;/*#5489E1;*/
}

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
	color: #FFA500; /*#FFFF00;*/
	background-color: #FFC;
}

.rating5 {
border: 1px solid #777;
	font-weight: bold;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #FF0000;
	background-color: #FFC;
}



.profileData {
     border: 1px solid #777;
	font-family: Georgia, "Times New Roman", Times, serif;
    font-size: 10px;
	color: #0000FF;
	background-color: #FFC;
}

.profileData02 {
border: 1px solid #777;    
	font-family: Georgia, "Times New Roman", Times, serif;
    font-size: 10px;
	color: #000000;
	background-color: #FFC;
}

.profileDataO {
border: 1px solid #777;
	font-family: Arial;
    font-size: 10px;
	color: #000000;
	background-color: #00FF00;
}


.profileDataX {
border: 1px solid #777;
	font-family: Arial;
    font-size: 10px;
	color: #000000;
	background-color: #FF0000;
}

.profileDataY {
border: 1px solid #777;
	font-family: Arial;
    font-size: 10px;
	color: #FFFF00;
	background-color: #0000FF;
}

.profileData2 {
    border: 1px solid #777;
	color: #000;
	text-align: center;
	font-size: 12px;
	font-weight: bold;
	font-family: Georgia, "Times New Roman", Times, serif;
	background-color: #FFC;
}


.profileData a {
	font-weight: bold;
	font-family: Georgia, "Times New Roman", Times, serif;
    font-size: 12px;
	color: #228B22;
	background-color: #FFC;
}



.profileData a:hover {
	font-weight: bold;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #0000FF;
	background-color: #FC0;
}

.profileData:hover {
	font-weight: bold;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #0000FF;
	background-color: #FC0;
}


</style>
</head>



<body>
<table width="100%" border="0">
  <tr>
    <th width="50%"  valign="top" scope="col"><table width="285" border="0" align="center">
      <tr>
        <th width="74" class="ProfileFields" style="text-align: left" scope="col">Usuário</th>
        <?php
            echo '<th width="201" bgcolor="#000" class="'.$rcolor.'" scope="col">';
        ?>

		<?php 
			echo $_SESSION['usrlogin']; 
		?>
        </th>
      </tr>
      <tr>
        <th class="ProfileFields" style="text-align: left">Capital</th>
        <th bgcolor="#CCCCCC" class="profileData2"><?php printf("%s", $capital); ?></th>
      </tr>
      <tr>
        <th class="ProfileFields" style="text-align: left">ELO</th>
        <th bgcolor="#CCCCCC" class="profileData2"><?php printf("%s", $rating); ?></th>
      </tr>
    </table></th>
    <th width="50%" valign="top" scope="col"><table width="360" border="0" align="center">
      <tr>
        <th class="ProfileFields" scope="col">Sala</th> 
        <th class="ProfileFields" scope="col">Rodada</th>
        <th class="ProfileFields" scope="col"> Status </th>
        <th class="ProfileFields" scope="col"> Pontuação </th>
      </tr>
      
      
      <?php viewPlayerRooms($_SESSION['usrid']); ?>
      
    </table></th>
  </tr>
</table>
</body>
</html>
