<?php

include_once ("config.php");
include_once ("maniadb.php");

function saveRelatorio($rodada, $idplayer) {
    $db = new maniadb;
    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);


    $id = $_SESSION['RoomId'];
    $round = $rodada;
    $time = time();

    $dbn = array('Fluxo de caixa', 'Balanco',
	'Demonstrativo de Resultados', 'Dados para tomada de decisao',
	'Emprestimos longo prazo');

    foreach ($dbn as $v) {
	$GLOBALS[$v]['id_room'] = $id;
	$GLOBALS[$v]['time'] = $time;
	$GLOBALS[$v]['id_player'] = $idplayer;
	$GLOBALS[$v]['round'] = $round;


	$db->query("SELECT * FROM `$v` WHERE id_player = $idplayer AND id_room = $id AND round = $round");

	$idDb = $db->nextRow();

	if (!$idDb) {
	    $query = getQueryInsert($v, $GLOBALS[$v]);
	} else {
	    $query = getQueryUpdate($v, $GLOBALS[$v], $idDb['id']);
	}

	$db->query($query);
    }

    $query = "UPDATE players SET pontuation = " .
	    $GLOBALS['Balanco']['Valor de venda da empresa'] .
	    " WHERE id_room = $id AND";
    $query .=" id_player = $idplayer";
    $db->query($query);

    $db->query("SELECT id FROM `Ranking sala` WHERE id_player = $idplayer AND id_room = $id AND round = $round");

    $idDb = $db->nextRow();

    if (!$idDb) {
	$query = "INSERT INTO `Ranking sala`(`id_player` , `id_room` , `round` , `time` ,`pontuation`)";
	$query .= " VALUES ($idplayer, $id, $round, $time," . $GLOBALS['Balanco']['Valor de venda da empresa'] . ")";
	$db->query($query);
    } else {
	$query = " UPDATE `Ranking sala` SET ";
	$query .= "  `time` = $time, `pontuation` = ";
	$query .= $GLOBALS['Balanco']['Valor de venda da empresa'] . " WHERE `id_room` = $id AND `round` = $round ";
	$query .= " AND `id_player` = $idplayer";
	$db->query($query);
    }


    $db->close();
}

function changeNumberFormat() {
    $dbn = array('Fluxo de caixa', 'Balanco',
	'Demonstrativo de Resultados', 'Dados para tomada de decisao',
	'Emprestimos longo prazo');

    foreach ($dbn as $v) {

	foreach ($GLOBALS[$v] as $key => $value) {
	    switch ($key) {
		case 'id_room': case 'time': case 'id_player': case 'round':
		    break;

		case 'Eficiencia das maquinas': case 'Eficiencia dos operarios':
		    $s = "";
		    if ($value < 0) {
			$s .= '<div style="color:#FF0000;">';
		    }
		    $s.= number_format($value, 2, ',', '.');
		    if ($value < 0) {
			$s .= '</div>';
		    }
		    $GLOBALS[$v][$key] = $s;
		    break;

		default:
		    $s = "";
		    if ($value < 0) {
			$s .= '<div style="color:#FF0000;">';
		    }
		    $s .= number_format($value, 0, ',', '.');
		    if ($value < 0) {
			$s .= '</div>';
		    }
		    $GLOBALS[$v][$key] = $s;
		    break;
	    }
	}
    }
}

function getMaxRod($idplayer) {
    $db = new maniadb;
    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);

    $id = $_SESSION['RoomId'];



    $query = "SELECT MAX(round) FROM `Balanco` WHERE id_player = $idplayer AND id_room = $id ";
    $db->query($query);


    $row = $db->nextRow();
    if ($row['MAX(round)'] != NULL) {
	$_SESSION['RelMaxRound'] = $row['MAX(round)'];
    } else {
	$_SESSION['RelMaxRound'] = -1;
    }
    $db->close();
}

function getThisRelatorio($rodada, $idplayer, $ropt) {

    $db = new maniadb;
    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);

    $id = $_SESSION['RoomId'];
    $round = $rodada;

    $time = time();


    if ($round < 0) {
	$loid = -$_SESSION['Tipo cenario'];
	$query = "SELECT * FROM `$ropt` WHERE id_player = $loid AND id_room = $loid AND round = $loid";
    } else {
	$query = "SELECT * FROM `$ropt` WHERE id_player = $idplayer AND id_room = $id AND round = $round";
    }
    $db->query($query);
    $row = $db->nextRow();

    if (!$row) {
	$db->close();
	return false;
    }


    foreach ($row as $key => $value) {

	switch ($key) {
	    case 'id_room': case 'time': case 'id_player': case 'round':
		break;

	    case 'Eficiencia das maquinas': case 'Eficiencia dos operarios':
		$s = "";
		if ($value < 0) {
		    $s .= '<div style="color:#FF0000;">';
		}
		$s.= number_format($value, 2, ',', '.');
		if ($value < 0) {
		    $s .= '</div>';
		}
		$GLOBALS[$ropt][$key] = $s;
		break;

	    default:
		$s = "";
		if ($value < 0) {
		    $s .= '<div style="color:#FF0000;">';
		}
		$s .= number_format($value, 0, ',', '.');
		if ($value < 0) {
		    $s .= '</div>';
		}
		$GLOBALS[$ropt][$key] = $s;
		break;
	}
    }

    $db->free();



    $db->close();
    return true;
}

function getRelatorio($rodada, $idplayer) {
    $db = new maniadb;
    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);

    $id = $_SESSION['RoomId'];
    $round = $rodada;

    $time = time();

    $dbn = array('Fluxo de caixa', 'Balanco',
	'Demonstrativo de Resultados', 'Dados para tomada de decisao',
	'Emprestimos longo prazo');


    foreach ($dbn as $v) {
	if ($round < 0) {

	    $loid = -$_SESSION['Tipo cenario'];
	    $query = "SELECT * FROM `$v` WHERE id_player = $loid AND id_room = $loid AND round = $loid";
	} else {
	    $query = "SELECT * FROM `$v` WHERE id_player = $idplayer AND id_room = $id AND round = $round";
	}
	$db->query($query);
	$row = $db->nextRow();

	if (!$row) {
	    $db->close();
	    //logXManager("Relatório $v não encontrado! \n");       
	    return false;
	}


	foreach ($row as $key => $value) {
	    $GLOBALS[$v][$key] = floatval($value);
	}
	$db->free();
    }



    $db->close();
    return true;
}

function isEliminated($idplayer, $roundC) {

    return !getRelatorio($roundC, $idplayer);
}

function make_seed() {
    list($usec, $sec) = explode(' ', microtime());
    return (float) $sec + ((float) $usec * 100000);
}

function simulador($vendaEstimada, $roundC, $idplayer, $simNow) {

    updateInfo();

    if (!getRelatorio($roundC - 1, $idplayer)) {
	return false;
    }


    foreach ($GLOBALS as $key => $value) {
	$$key = $value;
    }

    $db = new maniadb;
    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);

    $id = $_SESSION['RoomId'];


    if ($roundC > 0.1) {
	$db->query("UPDATE rooms SET slots = 0 WHERE id = $id ");
    }

    $db->query("UPDATE rooms SET current_round = $roundC WHERE id = $id ");
    $db->query("SELECT * FROM decisions WHERE id_player = $idplayer AND id_room = $id AND round = $roundC");

    $row = $db->nextRow();



    if (!$row) {

	$db->close();
	return false;
    }

    foreach ($row as $key => $value) {
	$$key = $value;
    }
    $PotencialAtual = $GLOBALS['Dados para tomada de decisao']['Potencial ELP'];

    if ($deelp > $PotencialAtual and $PotencialAtual > 0) {
	$deelp = $PotencialAtual;
    } elseif ($deelp < 0) {
	$deelp = 0;
    }


    $round_ant = $roundC - 1;

    $db->query("SELECT * FROM Media WHERE id_room = $id AND round = $round_ant");
    $row = $db->nextRow();
    if (!$row) {
	$loid = -$_SESSION['Tipo cenario'];
	$db->query("SELECT * FROM decisions WHERE id_room  = $loid");
	$row = $db->nextRow();

	if ($row) {
	    $MediaPreco = $row['depreco'] + 1;
	    $MediaPropaganda = $row['depropaganda'] + 1;
	    $MediaPrazo = $row['deprazo'] + 1;
	    $MediaPD = $row['dePD'] + 1;
	    $MediaDes = $row['dedesconto'] + 1;
	}
    } else {
	$MediaPreco = $row['Preco'] + 1;
	$MediaPropaganda = $row['Propaganda'] + 1;
	$MediaPrazo = $row['Prazo'] + 1;
	$MediaPD = $row['PD'] + 1;
	$MediaDes = $row['Desconto'] + 1;
    }

    $db->close();

    srand(make_seed());

    $PrecoRealDeVenda = $depreco * (1 - $dedesconto / 100.0);

    $MaquinaInicial = $GLOBALS['Dados para tomada de decisao']['Maquinas disponiveis'];
    if (-$demaquinas > $MaquinaInicial) {
	$demaquinas = -$MaquinaInicial;
    }

    $MaquinaFinal = $demaquinas + $MaquinaInicial;
    $GLOBALS['Dados para tomada de decisao']['Maquinas disponiveis'] = $MaquinaFinal;

    switch ($denturnos) {
	case 1:
	    $HorasTrabalhadas = 190.67;
	    $HorasDom = 220;
	    $HorasExtras = 48;
	    break;

	case 2:
	    $HorasTrabalhadas = 346.67;
	    $HorasDom = 200;
	    $HorasExtras = 48;
	    break;

	case 3:
	    $HorasTrabalhadas = 442.00;
	    $HorasDom = 170;
	    $HorasExtras = 48;
	    break;
    }

    if ($deHoraExtra) {
	$HorasTrabalhadas += 48;
    }


    $OperariosNecessarios = $MaquinaInicial * $denturnos * $OperariosMaquina;

    $EficienciaInicialMaquinas = $GLOBALS['Dados para tomada de decisao']['Eficiencia das maquinas'] / 100.0;
    $EficienciaInicialOperarios = $GLOBALS['Dados para tomada de decisao']['Eficiencia dos operarios'] / 100.0;
    $SalarioOperario = $GLOBALS['Dados para tomada de decisao']['Salario dos operarios'] *
	    (1 + $desalarioOperario / 100.0);

    $r = rand(0, 10);

    $EficienciaFinalOperario = $EficienciaInicialOperarios + 0.1 * $desalarioOperario / 100.0;

    $v1 = 0;
    $v2 = 0;

    if ($r >= 5) {
	if ($SalarioOperario * $desalarioOperario / 100.0 > 150) {
	    $v1 += $SalarioOperario * 0.0001;
	}
    }

    if ($deprazo < 0) {
	$deprazo = 0;
    }

    if ($deprazo > 100) {
	$deprazo = 100;
    }

    if ($dehmmaquinas < 0) {
	$dehmmaquinas = 0;
    }

    if ($deHoraExtra) {
	$v2 += -0.01;
	if ($r >= 5) {
	    $v2 += -0.01;
	}
    }

    $EficienciaFinalOperario += $v1 + $v2;

    $GLOBALS['Dados para tomada de decisao']['Eficiencia dos operarios'] = $EficienciaFinalOperario * 100.0;
    $GLOBALS['Dados para tomada de decisao']['Salario dos operarios'] = $SalarioOperario;

    $CoeficienteEngenheiro = $EficienciaEngenheiro[$deengenheiro];


    $r = rand(0, 10);

    $CoeficienteEstagiario = 0;

    if ($r * $deestagiarios >= 10) {
	$CoeficienteEstagiario += 0.98;
    } else {
	$CoeficienteEstagiario += 1 + 0.01 * $deestagiarios;
    }

    $CoeficienteMaquinas = $EficienciaInicialMaquinas * $EficienciaFinalOperario *
	    $CoeficienteEngenheiro * $CoeficienteEstagiario;



    $ProducaoTeorica = round($MaquinaInicial * $HorasTrabalhadas / $TempoFabricacao);


    $ProducaoCoeficientes = round($ProducaoTeorica * $CoeficienteMaquinas);

    $MateriaPrimaInicial = $GLOBALS['Dados para tomada de decisao']['Materia prima disponivel'];

    if ($MateriaPrimaInicial / $GLOBALS['MPNecessaria'] > $ProducaoCoeficientes) {
	$ProducaoPossivel = $ProducaoCoeficientes;
    } else {
	$ProducaoPossivel = intval($MateriaPrimaInicial / $GLOBALS['MPNecessaria']);
    }


    $GLOBALS['Dados para tomada de decisao']['Materia prima disponivel'] = $MateriaPrimaInicial - intval($ProducaoPossivel * $GLOBALS['MPNecessaria']) + $demateriaPrima;



    $PDAcumuladoInicial = $GLOBALS['Dados para tomada de decisao']['PD acumulado'];
    $PDAcumuladoFinal = $PDAcumuladoInicial + $dePD;
    $GLOBALS['Dados para tomada de decisao']['PD acumulado'] = $PDAcumuladoFinal;


    $EstoqueInicialProdutoAcabado = $GLOBALS['Dados para tomada de decisao']['Estoque final de produtos acabados'];

    $DisponivelParaVenda = $EstoqueInicialProdutoAcabado + $ProducaoPossivel;
    $DemandaGerada = 0;
    //$simNow = 0;

    if ($simNow) {
	$DemandaGerada = round($vendaEstimada * $DisponivelParaVenda / 100.0);
    } else {
	/* Calculo de demanda gerada */

	/* Influencia Preco */

	$precoD = 0;
	if ($PrecoRealDeVenda <= 480) {
	    $precoD = -0.0072 * pow($PrecoRealDeVenda, 3) + 9.96 * pow($PrecoRealDeVenda, 2) - 4756.4 * $PrecoRealDeVenda + 789750;
	} elseif ($PrecoRealDeVenda >= 480 and $PrecoRealDeVenda <= 520) {
	    $precoD = -10 * $PrecoRealDeVenda + 10000;
	} elseif ($PrecoRealDeVenda >= 520 and $PrecoRealDeVenda <= 880) {
	    $precoD = 0.00003 * pow($PrecoRealDeVenda, 3) - 0.0909 * pow($PrecoRealDeVenda, 2) + 68.86 * $PrecoRealDeVenda - 10648;
	}

	/* Influencia Prazo */

	$prazoD = 0.2 * $deprazo / 100.0;

	/* Influencia Propaganda */

	if ($depropaganda <= 8000) {
	    $propagandaD = -0.00003125 * pow($depropaganda, 2) + 0.5 * $depropaganda + 2000;
	} elseif ($depropaganda >= 8000 and $depropaganda <= 12000) {
	    $propagandaD = 0.5 * $depropaganda;
	} elseif ($depropaganda >= 12000 and $depropaganda <= 200000) {
	    $propagandaD = 4e-13 * pow($depropaganda, 3) - 5e-7 * pow($depropaganda, 2) + 0.1643 * $depropaganda + 4100;
	} else {
	    $propagandaD = 20160;
	}

	/* Influencia P&D */

	$PDD = $dePD * 0.006 / 1000 + $PDAcumuladoInicial * 0.0002 / 1000;

	if ($precoD < 1) {
	    $DemandaGerada = 0;
	} else {
	    $mediaH = 2 / (1 / ($Apreco * $precoD) + 1 / ($Apropaganda * $propagandaD));

	    if ($depreco != 0) {
		srand($_SESSION['RoomSeed']);
		for ($r = -1; $r <= $_SESSION['CurrRound']; ++$r) {
		    $ruido = rand(-20, 20) / 100.0;
		}

		if ($_SESSION['CurrRound'] < 1) {
		    $ruido = 0;
		}

		$DemandaGerada = $mediaH * (1 + $Aprazo * $prazoD) * (1 + $APD * $PDD) *
			1 * (1 + $ruido);

		if ($_SESSION["usrpriv"] > 1) {
		    echo "DEM real = $DemandaGerada";
		}

		$FPRECO = (1 - rand(500, 650) / 100000.00 * ($depreco - $MediaPreco) / $MediaPreco);
		$FPROP = (1 + rand(80, 160) / 100000.00 * ($depropaganda - $MediaPropaganda) / $MediaPropaganda);
		$FPRAZO = (1 + rand(80, 112) / 100000.00 * ($deprazo - $MediaPrazo) / $MediaPrazo);
		$FPD = (1 + rand(20, 40) / 100000.00 * ($dePD - $MediaPD) / $MediaPD);

		$FatorDecisao = $FPRECO *
			$FPROP *
			$FPRAZO *
			$FPD;


		$DemandaGerada = round($DemandaGerada * $FatorDecisao);
		if ($DemandaGerada < 0) {
		    $DemandaGerada = 0;
		}
		if ($_SESSION["usrpriv"] > 1) {
		    echo " Influencia = $FatorDecisao <p>";
		    echo " DEM com influencia = $DemandaGerada <p>";
		    echo " FPRECO = $FPRECO <p>";
		    echo " FPROP = $FPROP <p>";
		    echo " FPRAZO = $FPRAZO <p>";
		    echo " FPD = $FPD <p>";
		    echo " FDES = $FDES <p>";
		}
	    }
	}
    }


    $EstoqueFinalProdutoAcabado = 0;
    $Vendas = $DisponivelParaVenda;


    if ($DemandaGerada < $DisponivelParaVenda) {
	$EstoqueFinalProdutoAcabado = $DisponivelParaVenda - $DemandaGerada;
	$Vendas = $DemandaGerada;
    }

    $GLOBALS['Dados para tomada de decisao']['Quantidade vendida'] = $Vendas;
    $GLOBALS['Dados para tomada de decisao']['Quantidade produzida'] = $ProducaoPossivel;
    $GLOBALS['Dados para tomada de decisao']['Estoque inicial de produtos acabados'] = $EstoqueInicialProdutoAcabado;
    $GLOBALS['Dados para tomada de decisao']['Estoque final de produtos acabados'] = $EstoqueFinalProdutoAcabado;



    $ValorVendaMaquinas = $ValorMaquinaNova * (1 - $roundC / (12 * $VidaUtil)) * 0.6 + $ValorSucata;
    $EficienciaPerdidaMaquinas = $EficienciaInicialMaquinas - $PerdaPorMes - $HorasTrabalhadas * 0.0001;
    $v = 0.0123 * $dehmmaquinas + $EficienciaPerdidaMaquinas;

    if ($v > 1) {
	$v = 1;
    }
    if ($v < 0) {
	$v = $EficienciaPerdidaMaquinas;
    }

    $EficienciaComManutencao = $v;

    $EficienciaCompraMaquinas = $v;

    if ($demaquinas >= 0) {
	if ($v != 1) {
	    $EficienciaCompraMaquinas = ($MaquinaInicial * $v + $demaquinas) / $MaquinaFinal;
	}
    }

    $GLOBALS['Dados para tomada de decisao']['Eficiencia das maquinas'] = $EficienciaCompraMaquinas * 100.0;
    $InteressesNaoAtendidos = 0;

    if ($DemandaGerada > $DisponivelParaVenda) {
	$v = $DemandaGerada - $DisponivelParaVenda;
	if ($v > 0.1 * $DisponivelParaVenda) {
	    $v = 0.1 * $DisponivelParaVenda;
	}
	$InteressesNaoAtendidos = $v;
    }

    $GLOBALS['Dados para tomada de decisao']['Interesses nao atendidos'] = $InteressesNaoAtendidos;




    $VendasPrazoInicial = $GLOBALS['Balanco']['Vendas a prazo a receber'];
    $VendasPrazoFinal = $Vendas * $PrecoRealDeVenda * $deprazo / 100;
    $GLOBALS['Fluxo de caixa']['Vendas a prazo'] = $VendasPrazoInicial;

    $JurosVendasInicial = $GLOBALS['Demonstrativo de Resultados']['Juros sobre vendas a prazo'];
    $JurosVendasFinal = $VendasPrazoFinal * ($TaxaSelic);
    $GLOBALS['Demonstrativo de Resultados']['Juros sobre vendas a prazo'] = $GLOBALS['Balanco']['Juros vendas a prazo para receber'];


    $DepreciacaoMaquinasInicial = $GLOBALS['Demonstrativo de Resultados']['Depreciacao Maquinas Acumulada'];
    $DepreciacaoPredialInicial = $GLOBALS['Demonstrativo de Resultados']['Depreciacao Predial Acumulada'];
    $DepreciacaoMaquinasFinal = $DepreciacaoMaquinasInicial + $MaquinaInicial * $ValorMaquinaNova / (12.0 * $VidaUtil);
    $DepreciacaoPredialFinal = $DepreciacaoPredialInicial + $ValorPredialInicial / (20 * 12);
    $LucroInicial = $GLOBALS['Balanco']['Lucros acumulados'];
    $GLOBALS['Demonstrativo de Resultados']['Depreciacao Maquinas Acumulada'] = $DepreciacaoMaquinasFinal;
    $GLOBALS['Demonstrativo de Resultados']['Depreciacao Predial Acumulada'] = $DepreciacaoPredialFinal;


    $ReceitaVendas = $PrecoRealDeVenda * $Vendas;
    $GLOBALS['Fluxo de caixa']['Receita de vendas'] = $ReceitaVendas * (1 - $deprazo / 100.0);
    $GLOBALS['Demonstrativo de Resultados']['Receita de vendas'] = $ReceitaVendas;

    $ReceitaVendas = $PrecoRealDeVenda * $Vendas * (1 - $deprazo / 100.0);

    $GastosACC = 0;

    $GastosACC +=
	    $GLOBALS['Fluxo de caixa']['Compra de materia prima'] =
	    $GLOBALS['Demonstrativo de Resultados']['Compra de materia prima'] = $demateriaPrima * $GLOBALS['ValorMP'];

    $v = 0;
    if ($demaquinas > 0) {
	$v = $demaquinas;
    }

    $GastosACC +=
	    $GLOBALS['Fluxo de caixa']['Compra de maquinas'] = $v * $ValorMaquinaNova;

    $GastosACC +=
	    $GLOBALS['Fluxo de caixa']['Operacao de maquinas'] =
	    $GLOBALS['Demonstrativo de Resultados']['Operacao de maquinas'] =
	    ($HorasTrabalhadas * $CustoPorHoraFabricacao + $CustoFixoMensal) * $MaquinaInicial;
    $GastosACC +=
	    $GLOBALS['Fluxo de caixa']['Manutencao'] =
	    $GLOBALS['Demonstrativo de Resultados']['Manutencao'] = $dehmmaquinas * $MaquinaInicial * $Custohmanutencao;
    $CustoHE = 0;
    if ($deHoraExtra) {
	$CustoHE = round($SalarioOperario / $HorasDom * $ValorHE);
    }

    $GastosACC +=
	    $GLOBALS['Fluxo de caixa']['Salario de operarios'] =
	    $GLOBALS['Demonstrativo de Resultados']['Salario de operarios'] =
	    $OperariosNecessarios * ( $SalarioOperario + $CustoHE * $HorasExtras );


    $SalarioEngenheiro = $GLOBALS['SalarioEngenheiro'][$deengenheiro];
    $SalarioAdministrador = $GLOBALS['SalarioAdministrador'][$deadministrador];
    $SalarioSecretaria = $GLOBALS['SalarioSecretaria'][$desecretaria];
    $SalarioEstagiario = $GLOBALS['SalarioEstagiario'] * $deestagiarios;
    $SalarioVendedor = $GLOBALS['SalarioVendedor'][$devendedor];
    $SalarioSupervisorTurno = $denturnos * $GLOBALS['SalarioSupervisorTurno'];

    $GastosACC +=
	    $GLOBALS['Fluxo de caixa']['Salarios administrativos'] =
	    $GLOBALS['Demonstrativo de Resultados']['Salarios administrativos'] =
	    $SalarioEngenheiro + $SalarioAdministrador + $SalarioSecretaria + $SalarioEstagiario +
	    $SalarioVendedor + $SalarioSupervisorTurno;

    $EngenheiroInicial = $GLOBALS['Dados para tomada de decisao']['Engenheiro'];
    $SecretariaInicial = $GLOBALS['Dados para tomada de decisao']['Secretaria'];
    $AdministradorInicial = $GLOBALS['Dados para tomada de decisao']['Administrador'];
    $VendedorInicial = $GLOBALS['Dados para tomada de decisao']['Vendedor'];
    $EstagiariosInicial = $GLOBALS['Dados para tomada de decisao']['Estagiarios'];
    $SupervisorInicial = $GLOBALS['Dados para tomada de decisao']['Supervisor'];
    $OperariosInicial = $GLOBALS['Dados para tomada de decisao']['Operarios'];

    $GastosContratacao = 0;
    $GastosDemissao = 0;

    if ($EngenheiroInicial != $deengenheiro) {
	$GastosContratacao += $GLOBALS['SalarioEngenheiro'][$deengenheiro] * $GLOBALS['TaxaContratacao'];
	$GastosDemissao += $GLOBALS['SalarioEngenheiro'][$EngenheiroInicial] * $GLOBALS['TaxaDemissao'];
    }

    if ($SecretariaInicial != $desecretaria) {
	$GastosContratacao += $GLOBALS['SalarioSecretaria'][$desecretaria] * $GLOBALS['TaxaContratacao'];
	$GastosDemissao += $GLOBALS['SalarioSecretaria'][$SecretariaInicial] * $GLOBALS['TaxaDemissao'];
    }

    if ($AdministradorInicial != $deadministrador) {
	$GastosContratacao += $GLOBALS['SalarioAdministrador'][$deadministrador] * $GLOBALS['TaxaContratacao'];
	$GastosDemissao += $GLOBALS['SalarioAdministrador'][$AdministradorInicial] * $GLOBALS['TaxaDemissao'];
    }

    if ($VendedorInicial != $devendedor) {
	$GastosContratacao += $GLOBALS['SalarioVendedor'][$devendedor] * $GLOBALS['TaxaContratacao'];
	$GastosDemissao += $GLOBALS['SalarioVendedor'][$VendedorInicial] * $GLOBALS['TaxaDemissao'];
    }

    if ($denturnos > $SupervisorInicial) {
	$GastosContratacao +=
		$GLOBALS['SalarioSupervisorTurno'] * ($denturnos - $SupervisorInicial) * $GLOBALS['TaxaContratacao'];
    } else {
	$GastosDemissao +=
		$GLOBALS['SalarioSupervisorTurno'] * ($SupervisorInicial - $denturnos) * $GLOBALS['TaxaDemissao'];
    }

    if ($OperariosNecessarios > $OperariosInicial) {
	$GastosContratacao += $SalarioOperario * $GLOBALS['TaxaContratacao'] *
		($OperariosNecessarios - $OperariosInicial);
    } else {
	$GastosDemissao += $SalarioOperario * $GLOBALS['TaxaDemissao'] *
		($OperariosInicial - $OperariosNecessarios);
    }

    $GLOBALS['Dados para tomada de decisao']['Engenheiro'] = $deengenheiro;
    $GLOBALS['Dados para tomada de decisao']['Secretaria'] = $desecretaria;
    $GLOBALS['Dados para tomada de decisao']['Administrador'] = $deadministrador;
    $GLOBALS['Dados para tomada de decisao']['Vendedor'] = $devendedor;
    $GLOBALS['Dados para tomada de decisao']['Estagiarios'] = $deestagiarios;
    $GLOBALS['Dados para tomada de decisao']['Supervisor'] = $denturnos;
    $GLOBALS['Dados para tomada de decisao']['Operarios'] = $OperariosNecessarios;

    $GastosACC +=
	    $GLOBALS['Fluxo de caixa']['Contratacao'] =
	    $GLOBALS['Demonstrativo de Resultados']['Contratacao'] = $GastosContratacao;

    $GastosACC +=
	    $GLOBALS['Fluxo de caixa']['Demissao'] =
	    $GLOBALS['Demonstrativo de Resultados']['Demissao'] = $GastosDemissao;

    $CoeficienteAdministrador = $GLOBALS['EficienciaAdministrador'][$deadministrador];
    $CoeficienteSecretaria = $GLOBALS['EficienciaSecretaria'][$desecretaria];
    $GastosACC +=
	    $GLOBALS['Fluxo de caixa']['Propaganda'] =
	    $GLOBALS['Demonstrativo de Resultados']['Propaganda'] = $CoeficienteAdministrador * $depropaganda;
    $GastosACC +=
	    $GLOBALS['Fluxo de caixa']['P&D'] =
	    $GLOBALS['Demonstrativo de Resultados']['P&D'] = $dePD;
    $GastosACC +=
	    $GLOBALS['Demonstrativo de Resultados']['Depreciacao das maquinas'] =
	    $DepreciacaoMaquinasFinal - $DepreciacaoMaquinasInicial;
    $GastosACC += $GLOBALS['Demonstrativo de Resultados']['Depreciacao predial'] =
	    $DepreciacaoPredialFinal - $DepreciacaoPredialInicial;
    $GastosACC +=
	    $GLOBALS['Fluxo de caixa']['Comissoes'] =
	    $GLOBALS['Demonstrativo de Resultados']['Comissoes'] =
	    $GLOBALS['ComissaoVendedor'][$devendedor] * $GLOBALS['Demonstrativo de Resultados']['Receita de vendas'];

    $GastosACC +=
	    $GLOBALS['Fluxo de caixa']['Estoque'] =
	    $GLOBALS['Demonstrativo de Resultados']['Estoque'] =
	    $EstoqueFinalProdutoAcabado * $CustoEstoquePA +
	    $GLOBALS['Dados para tomada de decisao']['Materia prima disponivel'] * $CustoEstoqueMP;

    $ELPAcumulado = $GLOBALS['Emprestimos longo prazo']['Acumulado'];
    $JurosELP = $TaxaJurosELP * $ELPAcumulado;
    $GastosACC +=
	    $GLOBALS['Fluxo de caixa']['Juros sobre emprestimos'] =
	    $GLOBALS['Demonstrativo de Resultados']['Juros sobre emprestimos'] = $JurosELP + $GLOBALS['Balanco']['Juros de emprestimos de curto prazo a pagar'];
    $GLOBALS['Fluxo de caixa']['Gastos gerais'] =
	    $GLOBALS['Demonstrativo de Resultados']['Gastos gerais'] =
	    0.1 * $CoeficienteAdministrador * $CoeficienteSecretaria * $GastosACC;
    $GastosACC += $GLOBALS['Demonstrativo de Resultados']['Gastos gerais'];

    $GLOBALS['Fluxo de caixa']['Parcelas dos emprestimos'] = $ELPAcumulado * $GLOBALS['TaxaDeAmortizacao'];
    $GLOBALS['Emprestimos longo prazo']['Acumulado'] = $ELPAcumulado * (1 - $GLOBALS['TaxaDeAmortizacao']);
    if ($ELPAcumulado < $GLOBALS['ParcelaMinima']) {
	$GLOBALS['Fluxo de caixa']['Parcelas dos emprestimos'] = $ELPAcumulado;
	$GLOBALS['Emprestimos longo prazo']['Acumulado'] = 0;
    }

    $GLOBALS['Demonstrativo de Resultados']['Venda de maquinas'] = 0;
    if ($demaquinas < 0) {
	$GLOBALS['Demonstrativo de Resultados']['Venda de maquinas'] =
		-$demaquinas * $ValorVendaMaquinas;
    }
    $GLOBALS['Fluxo de caixa']['Venda de maquinas'] =
	    $GLOBALS['Demonstrativo de Resultados']['Venda de maquinas'];


    $GLOBALS['Fluxo de caixa']['Vendas a prazo'] = $GLOBALS['Balanco']['Vendas a prazo a receber'];
    $GLOBALS['Fluxo de caixa']['Emprestimo de longo prazo'] = $deelp;
    $GLOBALS['Emprestimos longo prazo']['Acumulado'] += $deelp;

    $GLOBALS['Fluxo de caixa']['Movimentacao de caixa'] =
	    $GLOBALS['Fluxo de caixa']['Compra de materia prima'] +
	    $GLOBALS['Fluxo de caixa']['Compra de maquinas'] +
	    $GLOBALS['Fluxo de caixa']['Manutencao'] +
	    $GLOBALS['Fluxo de caixa']['Contratacao'] +
	    $GLOBALS['Fluxo de caixa']['Demissao'] +
	    $GLOBALS['Fluxo de caixa']['Propaganda'] +
	    $GLOBALS['Fluxo de caixa']['P&D'] +
	    $GLOBALS['Fluxo de caixa']['Juros sobre emprestimos'] +
	    $GLOBALS['Fluxo de caixa']['Parcelas dos emprestimos'];

    $GLOBALS['Fluxo de caixa']['Caixa inicial'] = $GLOBALS['Fluxo de caixa']['Caixa final'];
    $GLOBALS['Fluxo de caixa']['Aplicacoes financeiras'] = 0;
    if ($GLOBALS['Fluxo de caixa']['Caixa inicial'] >
	    $GLOBALS['Fluxo de caixa']['Movimentacao de caixa']) {
	$GLOBALS['Fluxo de caixa']['Aplicacoes financeiras'] =
		$TaxaPoupanca * ($GLOBALS['Fluxo de caixa']['Caixa inicial'] -
		$GLOBALS['Fluxo de caixa']['Movimentacao de caixa']);
    }

    $GLOBALS['Balanco']['Aplicacoes financeiras'] =
	    $GLOBALS['Demonstrativo de Resultados']['Aplicacoes financeiras'] =
	    $GLOBALS['Fluxo de caixa']['Aplicacoes financeiras'];

    /* Resultado bruto */
    $GLOBALS['Demonstrativo de Resultados']['Resultado bruto'] =
	    $GLOBALS['Demonstrativo de Resultados']['Receita de vendas'] +
	    $GLOBALS['Balanco']['Aplicacoes financeiras'] +
	    $GLOBALS['Demonstrativo de Resultados']['Juros sobre vendas a prazo'] +
	    $GLOBALS['Fluxo de caixa']['Venda de maquinas'] -
	    $GastosACC + $GLOBALS['Fluxo de caixa']['Compra de maquinas'];
    $GLOBALS['Fluxo de caixa']['Impostos totais sobre vendas'] =
	    $GLOBALS['Demonstrativo de Resultados']['Impostos totais sobre vendas'] =
	    $GLOBALS['Demonstrativo de Resultados']['Receita de vendas'] * $GLOBALS['ImpostosTotaisVenda'];
    $GLOBALS['Demonstrativo de Resultados']['Lucro/prejuizo'] =
	    $GLOBALS['Demonstrativo de Resultados']['Resultado bruto'] -
	    $GLOBALS['Demonstrativo de Resultados']['Impostos totais sobre vendas'];

    $GastosTotais = $GLOBALS['Fluxo de caixa']['Movimentacao de caixa'] +
	    $GLOBALS['Demonstrativo de Resultados']['Operacao de maquinas'] +
	    $GLOBALS['Fluxo de caixa']['Salario de operarios'] +
	    $GLOBALS['Fluxo de caixa']['Salarios administrativos'] +
	    $GLOBALS['Fluxo de caixa']['Comissoes'] +
	    $GLOBALS['Fluxo de caixa']['Estoque'] +
	    $GLOBALS['Demonstrativo de Resultados']['Gastos gerais'] +
	    $GLOBALS['Fluxo de caixa']['Parcelas dos emprestimos'] +
	    $GLOBALS['Demonstrativo de Resultados']['Impostos totais sobre vendas']
    ;

    $GLOBALS['Fluxo de caixa']['Variacao do caixa'] =
	    $ReceitaVendas +
	    $GLOBALS['Balanco']['Aplicacoes financeiras'] +
	    $GLOBALS['Fluxo de caixa']['Venda de maquinas'] +
	    $VendasPrazoInicial +
	    $deelp - $GastosTotais;

    $GLOBALS['Fluxo de caixa']['Caixa final'] =
	    $GLOBALS['Fluxo de caixa']['Caixa inicial'] +
	    $GLOBALS['Fluxo de caixa']['Variacao do caixa'];

    $GLOBALS['Balanco']['Maquinas'] =
	    $MaquinaFinal * $ValorMaquinaNova - $GLOBALS['Demonstrativo de Resultados']['Depreciacao Maquinas Acumulada'];
    $GLOBALS['Balanco']['Construcoes predias'] = $ValorPredialInicial - $DepreciacaoPredialFinal;
    $GLOBALS['Balanco']['Terreno'] = $GLOBALS['ValorTerreno'];
    $GLOBALS['Balanco']['Caixa'] = $GLOBALS['Fluxo de caixa']['Caixa final'];
    $GLOBALS['Balanco']['Juros vendas a prazo para receber'] = $VendasPrazoFinal * ($TaxaSelic);
    $GLOBALS['Balanco']['Vendas a prazo a receber'] = $VendasPrazoFinal + $GLOBALS['Balanco']['Juros vendas a prazo para receber'];

    $GLOBALS['Balanco']['Estoque materia prima'] =
	    $GLOBALS['Dados para tomada de decisao']['Materia prima disponivel'] *
	    $GLOBALS['ValorMPEstoque'] *
	    $GLOBALS['ValorMP'];

    $GLOBALS['Balanco']['Estoque produto acabado'] =
	    $GLOBALS['ValorPA'] * $GLOBALS['Dados para tomada de decisao']['Estoque final de produtos acabados'];


    $GLOBALS['Balanco']['TOTAL DE ATIVOS'] =
	    $GLOBALS['Balanco']['Maquinas'] +
	    $GLOBALS['Balanco']['Construcoes predias'] +
	    $GLOBALS['Balanco']['Terreno'] +
	    $GLOBALS['Balanco']['Caixa'] +
	    $GLOBALS['Balanco']['Vendas a prazo a receber'] +
	    $GLOBALS['Balanco']['Estoque materia prima'] +
	    $GLOBALS['Balanco']['Estoque produto acabado'] +
	    $GLOBALS['Balanco']['Aplicacoes financeiras'];

    $GLOBALS['Balanco']['Emprestimos de longo prazo a pagar'] = $GLOBALS['Emprestimos longo prazo']['Acumulado'];
    $GLOBALS['Balanco']['Juros de emprestimos de longo prazo a pagar'] = 10 / 4 * $TaxaJurosELP * $GLOBALS['Emprestimos longo prazo']['Acumulado'];

    $GLOBALS['Balanco']['Emprestimo de curto prazo a pagar'] = 0;
    $GLOBALS['Balanco']['Juros de emprestimos de curto prazo a pagar'] = 0;

    if ($GLOBALS['Fluxo de caixa']['Movimentacao de caixa'] > $GLOBALS['Fluxo de caixa']['Caixa inicial']) {
	$GLOBALS['Balanco']['Emprestimo de curto prazo a pagar'] =
		$GLOBALS['Fluxo de caixa']['Movimentacao de caixa'] - $GLOBALS['Fluxo de caixa']['Caixa inicial'];

	$GLOBALS['Balanco']['Juros de emprestimos de curto prazo a pagar'] =
		$GLOBALS['JurosCP'] * $GLOBALS['Balanco']['Emprestimo de curto prazo a pagar'];
    }

    $GLOBALS['Balanco']['TOTAL DE PASSIVOS'] =
	    $GLOBALS['Balanco']['Emprestimos de longo prazo a pagar'] +
	    $GLOBALS['Balanco']['Juros de emprestimos de longo prazo a pagar'] +
	    $GLOBALS['Balanco']['Emprestimo de curto prazo a pagar'] +
	    $GLOBALS['Balanco']['Juros de emprestimos de curto prazo a pagar'];

    $GLOBALS['Balanco']['Capital social'] =
	    $GLOBALS['CapitalSocial'];

    $GLOBALS['Balanco']['Lucros acumulados'] = $LucroInicial + $GLOBALS['Demonstrativo de Resultados']['Lucro/prejuizo'];
    $GLOBALS['Balanco']['Patrimonio liquido'] =
	    $GLOBALS['Balanco']['Lucros acumulados'] + $GLOBALS['Balanco']['Capital social'];

    $GLOBALS['Balanco']['Valor de venda da empresa'] =
	    (1 - $GLOBALS['DesvalorizacaoHoraVenda']) * (
	    $GLOBALS['Balanco']['TOTAL DE ATIVOS'] -
	    $GLOBALS['Balanco']['TOTAL DE PASSIVOS'] +
	    $GLOBALS['Balanco']['Emprestimo de curto prazo a pagar']
	    );

    /* Dados emprestimo */
    $ValorVendaEmpresa = $GLOBALS['Balanco']['Valor de venda da empresa'];




    $PotencialRodada = $ValorVendaEmpresa * $EmprestimoMaximo -
	    $GLOBALS['Balanco']['Emprestimos de longo prazo a pagar'] -
	    $GLOBALS['Balanco']['Juros de emprestimos de longo prazo a pagar'];
    $GLOBALS['Dados para tomada de decisao']['Potencial ELP'] = $PotencialRodada;



    if (!$simNow) {
	saveRelatorio($roundC, $idplayer);
    }

    return true;
}

?>
