<?php
session_start();

setcookie("SID", SID);

function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float) $usec + (float) $sec);
}

$timeInitSession = microtime_float();

$funcao = "Home";

include_once("render.php");
if (array_key_exists('f', $_GET)) {
    $funcao = $_GET['f'];
    action($_GET['f']);
} else if (array_key_exists('f', $_POST)) {
    $funcao = $_POST['f'];
    action($_POST['f']);
}
$_GET['f'] = $_POST['f'] = $funcao;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

	<meta name="keywords" content="bussines game, jogo de negócios, simulador de empresas, simulador de empresas gratuíto, rede social profissional">
	<meta name="description" content="O simulador de empresas definitivo!">
	<meta name="robots" content="index,follow">

	<link rel="shortcut icon" type="image/x-icon" href="images/xmanager.ico">

	    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

	    <script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-38944340-1']);
		_gaq.push(['_setDomainName', 'xmanager.co']);
		_gaq.push(['_setCampNameKey', 'xmanager']);
		_gaq.push(['_setCampSourceKey', 'xmanager']);
		_gaq.push(['_setCampMediumKey', 'web']);
		_gaq.push(['_setCampTermKey', 'management game']);
		_gaq.push(['_setCampContentKey', 'business game']);
		_gaq.push(['_trackPageview']);

		(function() {
		    var ga = document.createElement('script');
		    ga.type = 'text/javascript';
		    ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
		    var s = document.getElementsByTagName('script')[0];
		    s.parentNode.insertBefore(ga, s);
		})();

	    </script>


	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <title> X-Manager</title>
	    <style type="text/css">
		body{
		    margin: 0;
		    padding: 0;
		    background-color: #000; /*#FFFFF0; /*#FFFFFF; /*#FFD700;*/
		    width: 100%;
		    height: 100%;
		    font-size: 14;
		    font-family: Times;
		    color: #FFFFFF;
		}
		.MenuPrincipal {
		    font-family: Comic Sans MS, cursive;
		    /*background-color: #ADFF2F;*/
		    background-color:  #000; /*#FFFFF0; /*#FFFFFF; /*#B0E0E6; /*#17507E;#17507E;*/

		    margin: 0;
		    padding: 0;
		}
		.MenuPrincipal td {
		    color: #FFFFFF;
		    font-family: Arial, Helvetica, sans-serif;
		    font-size: 12;
		}
		}
		.MenuFundo {
		    color: #FFF;
		    margin: 0;
		    padding: 0;
		}

		.MenuFundo .MenuPrincipal td {
		    color: #FFFFFF;
		    background-color: #000; /*#FFFFF0; /*#FFFFFF; /*#B0E0E6; /*#17507E;*/
		}

		.MenuPrincipal .MenuFundo .MenuPrincipal td div strong {
		    font-family: Comic Sans MS, cursive;
		}
		.MenuPrincipal .MenuFundo .MenuPrincipal td div strong {
		    font-family: Georgia, "Times New Roman", Times, serif;
		    color:  #FFFFF0; /*#FFFFFF; /*#B0E0E6; /*#17507E;*//*#FFF;*/
		}
		.phpFile {
		    color: #FFF;
		    background-color: #FFFFFF;
		}
		a {
		    text-align: center;
		    font-family: Georgia, "Times New Roman", Times, serif;
		    text-decoration: none;
		    color: #FFFFFF;
		}
		a:visited {
		    color: #FFFFFF;
		}
		a:hover {
		    color: #FFFF00;
		}
		a:active {
		    color: #FFFFFF;
		}

		.HoraServidor {
		    font-size: 10px;
		    color: #FF0000;
		    background-color: #000000;
		}


		.main-icon  {     
		    border: 1px solid #777;
		    width: 80px; 
		    height: 40px;
		    background-color: #8D8D8D;/*#175080; /*#191970;  #17507E*/
		    text-align: center;
		    vertical-align: center;
		    font-size: 12px;
		    font-family: Georgia, "Times New Roman", Times, serif;
		} 


		.main-icon2  {     
		    border: 1px solid #777;
		    width: 80px; 
		    height: 40px;
		    background-color: #8D8D8D;/*#191970; /*#191970;  #17507E*/
		    text-align: center;
		    vertical-align: center;
		    font-size: 12px;
		    font-family: Georgia, "Times New Roman", Times, serif;
		} 

		.main-icon  a { 
		    width: 80px;     
		    height: 40px;
		    background-color: #8D8D8D;/*#175080; /*#191970;*/
		    text-align: center;
		    vertical-align: center;
		    font-size: 12px;
		    font-family: Georgia, "Times New Roman", Times, serif;
		} 

		.main-icon:active  {  
		    border: 1px solid #777;  
		    background:  #8D8D8D;/*#175080; /*#191970;*/ 
		    width: 80px;
		    height: 40px;
		    text-align: center;
		    vertical-align: center;
		    font-size: 12px;
		    font-family: Georgia, "Times New Roman", Times, serif; 
		}

		.main-icon:hover   a {     
		    background: #191970; 
		    width: 80px; 
		    height: 40px;
		    text-align: center;
		    vertical-align: center;
		    font-size: 12px;
		    font-family: Georgia, "Times New Roman", Times, serif;
		} 

		.main-icon:hover   {     
		    border: 1px solid #777;
		    background: #191970; 
		    width: 80px; 
		    height: 40px;
		    text-align: center;
		    vertical-align: center;
		    font-size: 12px;
		    font-family: Georgia, "Times New Roman", Times, serif;
		} 

	    </style>
    </head>


    <div id="fb-root"></div>
    <script>
	window.fbAsyncInit = function() {
	    // init the FB JS SDK
	    FB.init({
		appId: '474705362550176', // App ID from the App Dashboard
		channelUrl: '//http://xmanager.co/', // Channel File for x-domain communication
		status: true, // check the login status upon init?
		cookie: true, // set sessions cookies to allow your server to access the session?
		xfbml: true  // parse XFBML tags on this page?
	    });

	    // Additional initialization code such as adding Event Listeners goes here

	};

	// Load the SDK's source Asynchronously
	// Note that the debug version is being actively developed and might 
	// contain some type checks that are overly strict. 
	// Please report such bugs using the bugs tool.
	(function(d, debug) {
	    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	    if (d.getElementById(id)) {
		return;
	    }
	    js = d.createElement('script');
	    js.id = id;
	    js.async = true;
	    js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
	    ref.parentNode.insertBefore(js, ref);
	}(document, /*debug*/false));
    </script>

    <body class="MenuPrincipal">

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id))
		    return;
		js = d.createElement(s);
		js.id = id;
		js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=474705362550176";
		fjs.parentNode.insertBefore(js, fjs);
	    }(document, 'script', 'facebook-jssdk'));</script>


	<script type="text/javascript"><!--
	google_ad_client = "ca-pub-6602352890672254";
	    /* xmanager */
	    google_ad_slot = "2980571982";
	    google_ad_width = 728;
	    google_ad_height = 90;
	    //-->
	</script>

	<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
	</script>


	<div class="fb-like" data-href="https://www.facebook.com/xmanagergrupo" data-send="true" data-width="450" data-show-faces="false" data-font="arial" data-colorscheme="dark"></div>

	<table width="100%" border="0" cellpadding="0" cellspacing="0" padding="0" margin="0" class="MenuFundo" valign="top">

	    <tr class="MenuPrincipal">

		<td width="15%">
		    <img src="images/banner.png" height="30" padding="0" margin="0" border="0" align="right"/>
		</td>

		<td>

		    <?php
		    echo '<th width="80%" align="right">';
		    echo "<table> <tr>";

		    if (strcmp($funcao, "Home") != 0) {
			echo '<th align="center" valign="center" class="main-icon"><a href="index.php?f=Home&g=Inicio" title="Home">' .
			'Home' .
			'</a></th>';
		    } else {
			echo '<th align="center" valign="center" class="main-icon2"><a href="index.php?f=Home&g=Inicio" title="Home">' .
			'Home' .
			'</a></th>';
		    }

		    if (strcmp($funcao, "Home") != 0) {
			echo '<th align="center" valign="center" class="main-icon"><a href="index.php?f=Forum" title="Forum">' .
			'Fórum' .
			'</a></th>';
		    } else {
			echo '<th align="center" valign="center" class="main-icon2"><a href="index.php?f=Forum" title="Forum">' .
			'Fórum' .
			'</a></th>';
		    }

		    if (strcmp($funcao, "Home") != 0) {
			echo '<th align="center" valign="center" class="main-icon"><a href="index.php?f=Wiki" title="Wiki">' .
			'Wiki' .
			'</a></th>';
		    } else {
			echo '<th align="center" valign="center" class="main-icon2"><a href="index.php?f=Wiki" title="Wiki">' .
			'Wiki' .
			'</a></th>';
		    }

		    if (strcmp($funcao, "Home") != 0) {
			echo '<th align="center" valign="center" class="main-icon"><a href="index.php?f=Blog" title="Blog">' .
			'Blog' .
			'</a></th>';
		    } else {
			echo '<th align="center" valign="center" class="main-icon2"><a href="index.php?f=Blog" title="Blog">' .
			'Blog' .
			'</a></th>';
		    }


		    if (strcmp($funcao, "Home") != 0) {
			echo '<th align="center" valign="center" class="main-icon"><a href="index.php?f=Chat" title="Chat">' .
			'Chat' .
			'</a></th>';
		    } else {
			echo '<th align="center" valign="center" class="main-icon2"><a href="index.php?f=Chat" title="Chat">' .
			'Chat' .
			'</a></th>';
		    }

		    if (strcmp($funcao, "VerRankingGlobal") != 0) {
			echo '<th align="center" valign="center" class="main-icon"><a href="index.php?f=VerRankingGlobal" title="Ranking">' .
			'Top 50' .
			'</a></th>';
		    } else {
			echo '<th align="center" valign="center" class="main-icon2"><a href="index.php?f=VerRankingGlobal" title="Ranking">' .
			'Top 50' .
			'</a></th>';
		    }

		    if (array_key_exists('usrlogin', $_SESSION) and strcmp($_GET['f'], 'Logout') != 0) {

			if (strcmp($funcao, "Rooms") != 0) {
			    echo '<th align="center" valign="center" class="main-icon"><a href="index.php?f=Rooms" title="Salas">' .
			    'Salas novas' .
			    '</a></th>';
			} else {
			    echo '<th align="center" valign="center" class="main-icon2"><a href="index.php?f=Rooms" title="Salas">' .
			    'Salas novas' .
			    '</a></th>';
			}

			if (strcmp($funcao, "Profile") != 0) {
			    echo '<th align="center" valign="center" class="main-icon"><a href="index.php?f=Profile" title="Perfil">' .
			    'Perfil' .
			    '</a></th>';
			} else {
			    echo '<th align="center" valign="center" class="main-icon2"><a href="index.php?f=Profile" title="Perfil">' .
			    'Perfil' .
			    '</a></th>';
			}

			if (strcmp($funcao, "Logout") != 0) {
			    echo '<th align="center" valign="center" class="main-icon"><a href="index.php?f=Logout" title="Sair">' .
			    'Sair' .
			    '</a></th>';
			} else {
			    echo '<th align="center" valign="center" class="main-icon2"><a href="index.php?f=Logout" title="Sair">' .
			    'Sair' .
			    '</a></th>';
			}
		    } else {

			if (strcmp($funcao, "Registrar") != 0) {
			    echo '<th align="center" valign="center" class="main-icon"><a href="index.php?f=Registrar" title="Registrar">' .
			    'Registrar' .
			    '</a></th>';
			} else {
			    echo '<th align="center" valign="center" class="main-icon2"><a href="index.php?f=Registrar" title="Registrar">' .
			    'Registrar' .
			    '</a></th>';
			}

			if (strcmp($funcao, "Login") != 0) {
			    echo '<th align="center" valign="center" class="main-icon"><a href="index.php?f=Login" title="Autenticar usuário">' .
			    'Login' .
			    '</a></th>';
			} else {
			    echo '<th align="center" valign="center" class="main-icon2"><a href="index.php?f=Login" title="Autenticar usuário">' .
			    'Login' .
			    '</a></th>';
			}
		    }
		    echo "</tr></table></th>";
		    ?>

		</td>
	    </tr>
	</table>

	<table width="100%" height="520" border="0" cellpadding="0" cellspacing="0">

	    <tr height="100%">

		<td width="100%" height="100%" valign="top"  bgcolor="#000"> <!--bgcolor="#BEBEBE"> <!--/*#FFFFFF" > <!--bgcolor="#B0E0E6">  -->
		    <?php
		    if (array_key_exists('f', $_GET)) {
			switch ($_GET['f']) {
			    case 'Chat': break;
			    default: echo '<div align="center">';
			}
			render($_GET['f']);
		    } else if (array_key_exists('f', $_POST)) {
			render($_POST['f']);
		    }
		    ?> 
		    </div>

		</td>
	    </tr>
	</table>

	<table width="100%" height="70" margin="0" padding="0" valign="bottom" bgcolor="#333333"> <!---"#17507E"--> 

	    <tr><th colspan="3"  align="left" class="HoraServidor" height="20">

		    <?php
		    $time = date('H:i d/m/Y');

		    $timeElapsed = microtime_float() - $timeInitSession;
		    print "Página gerada em ";
		    printf("%.0lf ms", 1000 * ($timeElapsed));
		    print " às {$time}\n\n";

		    setTimePageGen($timeElapsed);
		    ?>

		</th></tr>

	    <tr >
		<th align="left" valign="top" style="font-size: 10px; color: #00000F" width="70%">
		    Copyright &copy; GoHug, software desenvolvido por <b>Huiran Fornazieri</b> e <b>Péricles Lopes Machado</b>. 
		</th>
	    </tr>

	    <tr>
		<th align="left" valign="top" style="font-size: 10px; color: #00000F" width="70%">
		    Designers: <b>Ana Leticia Rico</b> e <b>Mateus Ribeiro</b>. 
		</th>
	    </tr>

	</table>
    </body>
</html>
