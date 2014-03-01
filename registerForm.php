<!DOCTYPE html PUBLIC "-//W3C//Dth XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Dth/xhtml1-transitional.dth">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.RegistrarUsuario {
	color: #FFFFFF;
	background-color:  #AFAFAF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	text-decoration: none;
}
#form1 .RegistrarUsuario tr th {
	font-family: Georgia, "Times New Roman", Times, serif;
}

#BotaoRegistraUsuario {
 border: 1px solid #FFFFFF;
color: #FFFFFF;
border: 1;
background-color: #BEBEBE;
}




#BotaoRegistraUsuario:active {
border: 1px solid #FFFFFF;
color: #FFFFFF;
border: 1;
background-color: #BEBEBE;
}

#BotaoRegistraUsuario:hover {
border: 1px solid #FFFFFF;
color: #FFFFFF;
border: 1;
background-color: #FF0000;
cursor:pointer;
}


</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="index.php">
<table width="244" height="124" border="0" align="center" cellpadding="2" cellspacing="2" class="RegistrarUsuario">
<tr><th>
<fieldset >
    <legend > <div style="color: #FFFF00;">Registrar usuário</div></legend>
<table>
  <tr>
    <th width="93" class="RegistrarUsuario" align="left">Usuário:</th>
    <th width="153">
      <input name="usr" type="text" size="25%" maxlength="10" />
   	</th>
  </tr>
  <tr>
    <th class="RegistrarUsuario" align="left">Senha:</th>
    <th><input name="pwd" type="password" size="25%" maxlength="10" /></th>
  </tr>
  <tr>
    <th class="RegistrarUsuario" align="left">Confirmar Senha:</th>
    <th class="RegistrarUsuario"><input name="pwdc" type="password" size="25%" maxlength="10" /></th>
  </tr>
  <tr>
    <th align="left">
    Você é um robô?
    </th>
  </tr>
  <tr>
    <th colspan="2">
      <div align="center">
<?php
  require_once('recaptchalib.php');
  $publickey = "6LdbidcSAAAAAGDfRU5oZWKvRQs96LZeNHVZtVUi"; // you got this from the signup page
  echo recaptcha_get_html($publickey);
?>

      	<input type="hidden" name="f" value="RegistrarUsuario">
        <input type="submit" name="BotaoRegistraUsuario" id="BotaoRegistraUsuario" value="Registrar" />
      </div>
    </th>
  </tr>
</table>
</fieldset>
</td></tr>
</table>

<div align="left"></div>

</form>

</body>
</html>
