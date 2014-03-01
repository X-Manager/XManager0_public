<?php

include_once("config.php");
include_once("login.php");
include_once("rooms.php");

function action($opt) {
    switch ($opt) {

	case 'AutenticarUsuario':

	    if (array_key_exists('usr', $_POST) &&
		    array_key_exists('pwd', $_POST)) {
		authenticate_user($_POST['usr'], $_POST['pwd']);
	    }
	    break;


	case 'Logout':
	    foreach ($_COOKIE as $key => $value) {
		setcookie($key, '', -10000);
	    }
	    session_destroy();
	    break;


	case 'CriarSala':
	    createRoom($_POST['RoomName']);
	    break;

	case 'SalvarSalaDecisao':
	    saveDecisionRoom();
	    break;
    }
}

function render($opt) {
    switch ($opt) {
	case 'Registrar':
	    include_once("registerForm.php");
	    break;

	case 'RegistrarUsuario':
	    require_once('recaptchalib.php');
	    $privatekey = "6LdbidcSAAAAAD2iBoCo4UzW4W2NLYrSnoT10bFO";
	    $resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

	    if (!$resp->is_valid) {
		include_once("registerForm.php");
		logXManager("Por favor, digite corretamente os caracteres que aparecem na imagem!\n");
	    } elseif (array_key_exists('usr', $_POST) &&
		    array_key_exists('pwd', $_POST)) {
		if ($_POST['pwd'] == $_POST['pwdc']) {
		    add_user($_POST['usr'], $_POST['pwd']);
		} else {
		    include_once("registerForm.php");
		    logXManager("É preciso digitar a mesma senha duas vezes!\n");
		}
	    } else {
		include_once("registerForm.php");
		logXManager("Todos campos precisam ser preenchidos!\n");
	    }
	    break;



	case 'Login':
	    include_once("loginForm.php");
	    break;



	case 'AutenticarUsuario':
	    if (!(array_key_exists('usr', $_POST) &&
		    array_key_exists('pwd', $_POST))) {
		include_once("loginForm.php");
		logXManager("Todos campos precisam ser preenchidos!\n");
	    }
	case 'Chat':
	    echo '<iframe src="chatForm.php" width="100%" height="900" valign="top" margin="0" border="0"> </iframe>';
	    break;

	case 'Profile':
	    include_once('profileViewForm.php');
	    break;


	case 'Rooms':
	    include_once('roomsViewForm.php');
	    break;

	case 'CriarSala':
	    include_once('roomsViewForm.php');
	    break;

	case 'VerSala':
	    if (!array_key_exists('usrlogin', $_SESSION)) {
		logXManager("Você tem de logar primeiro!\n");
		include_once('home.php');
	    } else {
		viewRoom($_GET['RoomId']);
	    }
	    break;

	case 'VerSalaDecisao':
	    viewDecisionRoom();
	    break;

	case 'VerRelatorios':
	    viewRelatorio();
	    break;

	case 'VerSimulador':
	    viewSimulador();
	    break;

	case 'VerInfo':
	    viewInfo();
	    break;

	case 'VerRanking':
	    viewRanking();
	    break;


	case 'VerRankingGlobal':
	    viewGlobalRanking();
	    break;


	case 'SalvarSalaDecisao':
	    $_GLOBALS['isdecision'] = true;
	    $_GLOBALS['isrelatorio'] = false;
	    $_GLOBALS['issimulador'] = false;
	    $_GLOBALS['isinfo'] = false;
	    $_GLOBALS['isrank'] = false;

	    include_once('roomForm.php');
	    break;




	case 'Wiki':
	    include_once('wikiForm.php');
	    break;

	case 'Blog':
	    include_once('blogForm.php');
	    break;



	case 'Forum':
	    include_once('forumForm.php');
	    break;

	case 'Home':
	default:

	    include_once('home.php');
	    break;
    }
}
?>


