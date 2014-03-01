<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:ice="http://ns.adobe.com/incontextediting">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.RegistrarUsuario {	color: #FFFFFF;
	background-color:  #AFAFAF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
    border-collapse: collapse;
	text-decoration: none;
}
#form1 .RegistrarUsuario tr .RegistrarUsuario {
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

.form {
 border-radius: 5px;
 -webkit-border-radius: 5px;
 -moz-border-radius: 5px;
}

</style>
<script src="includes/ice/ice.js" type="text/javascript"></script>
</head>

<body>



<form id="form1" name="form1" method="post" action="index.php" class="form">

<table width="225" height="116" border="0" align="center" cellpadding="2" cellspacing="2" class="RegistrarUsuario">
<tr><th><fieldset>
    <legend class="form" > <div style="color: #FFFF00;">Autenticar usuário</div></legend>
<table>
  <tr>
    <th width="56" class="RegistrarUsuario" align="left">Usuário:</th>
    <th width="155"><input name="usr" type="text" size="25%" maxlength="10" /></th>
</tr>
  <tr>
    <th class="RegistrarUsuario" align="left">Senha:</th>
    <th><input name="pwd" type="password" size="25%" maxlength="10" /></th>
  </tr>
  <tr>
    <th colspan="2"><div align="center">
      <input type="hidden" name="f" value="AutenticarUsuario" />
      <input type="submit" name="BotaoRegistraUsuario" id="BotaoRegistraUsuario" value="Login" />
    </div></th>
   
  </tr>
</table>
</fieldset></th></tr>

</table>

   
</form>


</body>
</html>
