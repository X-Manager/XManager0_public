<?php

include_once("maniadb.php");

$NumCenarios = 3;
$myplace = 3;
/*
  Arquivo com configurações diversas do sistema
 */

/* Nome do banco de dados */
if ($myplace == 1) {
    $mydb = "xxxxxx";
} elseif ($myplace == 2) {
    $mydb = "xxxxxx";
} elseif ($myplace == 3) {
    $mydb = "xxxxxxxxxxx";
} else {
    $mydb = "xxxxxxxxx";
}

/* Nome do usuario do banco de dados */
if ($myplace == 1) {
    $mydbusr = "root";
} elseif ($myplace == 2) {
    $mydbusr = "root";
} elseif ($myplace == 3) {
    $mydbusr = "xxxxxx";
} else {
    $mydbusr = "xxxx";
}
/* Senha do usuario do banco de dados */
if ($myplace == 1) {
    $mydbpwd = "";
} elseif ($myplace == 2) {
    $mydbpwd = "xxxxx";
} elseif ($myplace == 3) {
    $mydbpwd = "xxxxxxxx";
} else {
    $mydbpwd = "xxxxxxx";
}
/* Caminho para o banco de dados */
if ($myplace == 1) {
    $mydbpath = "localhost";
} elseif ($myplace == 2) {
    $mydbpath = "localhost";
} elseif ($myplace == 3) {
    $mydbpath = "xxxxxxxxxxxxxxxxxx";
} else {
    $mydbpath = "xxxxxxxxxxx";
}
/* Tempo seção */
$mysessiontime = 60000;
$mysessionpath = "/maniadmin/";

$myroomnslots = 10;
$myroomnrounds = 6;
$myroomweight = 40;
$myroomroundduration = 1 * 24 * 60 * 60 + 0 * 60 * 60 + 10 * 60 + 0;

/* Parametros do jogo */

$sazonalidade = array(
    -1 => 1,
    0 => 0.9,
    1 => 1.2,
    2 => 1.2,
    3 => 1,
    4 => 0.9,
    5 => 1.2,
    6 => 1.2,
    7 => 1,
    8 => 0.9,
    9 => 1.2,
    10 => 1.2,
    11 => 1,
    12 => 0.9,
    13 => 1.2,
    14 => 1.2,
    15 => 1,
    16 => 0.9,
    17 => 1.2,
    18 => 1.2,
    19 => 1,
    20 => 0.9
);

$ruido = array(
    -1 => 1,
    0 => 1.000,
    1 => 1.000,
    2 => 1.003,
    3 => 1.010,
    4 => 0.999,
    5 => 0.998,
    6 => 1.005,
    7 => 1.010,
    8 => 1.002,
    9 => 0.994,
    10 => 0.996,
    11 => 1.002,
    12 => 1.008,
    13 => 1.004,
    14 => 0.997,
    15 => 0.998,
    16 => 1.000,
    17 => 1.004,
    18 => 0.997,
    19 => 1.000,
    20 => 0.999
);

$SalarioMinimo = 622;

$SalarioEngenheiro = array(
    0 => $SalarioMinimo * 9,
    1 => $SalarioMinimo * 8,
    2 => $SalarioMinimo * 6
);
$EficienciaEngenheiro = array(
    0 => 1.01,
    1 => 1.00,
    2 => 0.99
);
$SalarioAdministrador = array(
    0 => $SalarioMinimo * 9,
    1 => $SalarioMinimo * 8,
    2 => $SalarioMinimo * 6
);
$EficienciaAdministrador = array(
    0 => 0.98,
    1 => 0.99,
    2 => 1
);
$SalarioSecretaria = array(
    0 => $SalarioMinimo * 1.2,
    1 => $SalarioMinimo * 1.1,
    2 => $SalarioMinimo * 1
);
$EficienciaSecretaria = array(
    0 => 0.995,
    1 => 0.998,
    2 => 1
);
$SalarioVendedor = array(
    0 => $SalarioMinimo * 4,
    1 => $SalarioMinimo * 2
);
$ComissaoVendedor = array(
    0 => 0.1 / 100,
    1 => 0.2 / 100
);

$SalarioEstagiario = $SalarioMinimo * 1.3;
$SalarioSupervisorTurno = $SalarioMinimo * 4;

$SalarioEngA = $SalarioEngenheiro[0];
$SalarioEngB = $SalarioEngenheiro[1];
$SalarioEngC = $SalarioEngenheiro[2];

$SalarioAdmA = $SalarioAdministrador[0];
$SalarioAdmB = $SalarioAdministrador[1];
$SalarioAdmC = $SalarioAdministrador[2];

$SalarioSecA = $SalarioSecretaria[0];
$SalarioSecB = $SalarioSecretaria[1];
$SalarioSecC = $SalarioSecretaria[2];

$SalarioVendA = $SalarioVendedor[0];
$SalarioVendB = $SalarioVendedor[1];

$ComissaoVendA = (100 * $ComissaoVendedor[0]);
$ComissaoVendB = (100 * $ComissaoVendedor[1]);

$ParametrosJogoSalario = array(
    'SalarioMinimo' => 'Salário Mínimo (R$)',
    'SalarioEstagiario' => 'Salário do estagiário (R$)',
    'SalarioSupervisorTurno' => 'Salário do supervisor de turno',
    'SalarioEngA' => 'Salário do engenheiro A',
    'SalarioEngB' => 'Salário do engenheiro B',
    'SalarioEngC' => 'Salário do engenheiro C',
    'SalarioAdmA' => 'Salário do administrador A',
    'SalarioAdmB' => 'Salário do administrador B',
    'SalarioAdmC' => 'Salário do administrador C',
    'SalarioSecA' => 'Salário da secretária A',
    'SalarioSecB' => 'Salário da secretária B',
    'SalarioSecC' => 'Salário da secretária C',
    'SalarioVendA' => 'Salário do vendedor A',
    'SalarioVendB' => 'Salário do vendedor B',
);

$TaxaDemissao = 1.3;
$TaxaContratacao = 0.1;
$ImpostosTotaisVenda = 0.34;
$ValorTerreno = 100000;
$ValorMPEstoque = 0.4;
$ValorMP = 50;
$ValorPA = 150;
$JurosCP = 8 / 100;
$CapitalSocial = 1300000;
$DesvalorizacaoHoraVenda = 5 / 100;
$OperariosMaquina = 5;
$TempoFabricacao = 2;
$ValorMaquinaNova = 25000.0;
$VidaUtil = 10.0;
$ValorSucata = 2500;
$PerdaPorMes = 0.04;
$TaxaSelic = 0.6 / 100;
$ValorPredialInicial = 500000;
$CustoPorHoraFabricacao = 1;
$CustoFixoMensal = 500;
$Custohmanutencao = 20;
$ValorHE = 150 / 100;
$CustoEstoquePA = 1;
$CustoEstoqueMP = 0.1;
$TaxaJurosELP = 1 / 100;
$TaxaPoupanca = 0.5 / 100.0;
$EmprestimoMaximo = 80 / 100;
$MPNecessaria = 1;

$TaxaDeAmortizacao = 25 / 100;
$ParcelaMinima = 10000;

/* pesos das decisões */
$prand = 0.2;
$rand = $prand * rand(0, 100) / 100.0;
$Apreco = 0.20 * (1 + $rand - $prand * 0.5);
$Aprazo = 1.00 * (1 + $rand - $prand * 0.5);
$Apropaganda = 1.00 * (1 + $rand - $prand * 0.5);
$APD = 0.60 * (1 + $rand - $prand * 0.5);


$ParametrosJogo = array(
    'ValorTerreno' => 'Valor do terreno (R$)',
    'ValorMPEstoque' => 'Valor da matéria-prima no estoque - balanço (%)',
    'ValorMP' => 'Valor de compra de uma unidade de matéria-prima (R$)',
    'ValorPA' => 'Valor do produto acabado no balanço (R$)',
    'CapitalSocial' => 'Capital social (R$)',
    'OperariosMaquina' => 'Operários necessários por máquina',
    'TempoFabricacao' => 'Tempo de fabricação de cada produto (horas)',
    'ValorMaquinaNova' => 'Valor de compra de uma máquina nova (R$)',
    'VidaUtil' => 'Vida útil das máquinas (anos)',
    'ValorSucata' => 'Valor da sucata da máquina (R$)',
    'ValorPredialInicial' => 'Valor inicial dos prédios/instalações (R$)',
    'ParcelaMinima' => 'Parcela mínima do longo prazo (R$)'
);

$ParametrosJogoTaxa = array(
    'TaxaDeAmortizacao' => 'Taxa de amortização do emprestimo de longo prazo',
    'ComissaoVendA' => 'Comissão do vendedor A',
    'ComissaoVendB' => 'Comissão do vendedor B',
    'ValorHE' => 'Valor da hora extra',
    'EmprestimoMaximo' => 'Potencial de emprestimo de longo prazo (% do valor de venda da empresa)',
    'TaxaDemissao' => 'Taxa de demissão',
    'TaxaContratacao' => 'Taxa de contratação',
    'ImpostosTotaisVenda' => 'Imposto totais de venda',
    'DesvalorizacaoHoraVenda' => 'Desvalorização da empresa na hora da venda',
    'PerdaPorMes' => 'Perda de eficiência mensal',
    'TaxaSelic' => 'Taxa Selic',
    'TaxaPoupanca' => 'Taxa de juros da poupança',
    'JurosCP' => 'Juros de curto prazo',
    'TaxaJurosELP' => 'Taxa de juros dos empréstimos de longo prazo',
);

$ParametrosJogoCustos = array(
    'CustoPorHoraFabricacao' => 'Custo por hora de fabricação (R$)',
    'CustoFixoMensal' => 'Custo fixo mensal por máquina (R$)',
    'Custohmanutencao' => 'Custo por hora de manutenção por máquina (R$)',
    'CustoEstoquePA' => 'Custo de armanezamento do produto acabado (R$)',
    'CustoEstoqueMP' => 'Custo de armanezamento da matéria-prima (R$)',
);



$DecisionFields = array(
    'demateriaPrima',
    'demaquinas',
    'dehmmaquinas',
    'denturnos',
    'deHoraExtra',
    'dePD',
    'depreco',
    'dedesconto',
    'deprazo',
    'depropaganda',
    'deelp',
    'deengenheiro',
    'deadministrador',
    'desecretaria',
    'deestagiarios',
    'devendedor',
    'desalarioOperario',
);

$DecisionNames = array(
    'Compra de materia prima',
    'Compra/venda de maquinas',
    'Horas de manutencao por maquina',
    'Turnos utilizados',
    'Hora extra',
    'P&D',
    'Preco',
    'Desconto (%)',
    'Vendas a prazo (%)',
    'Propaganda',
    'Emprestimo de longo prazo',
    'Engenheiro',
    'Administrador',
    'Secretaria',
    'Estagiario de engenharia',
    'Vendedor',
    'Aumento salario dos operarios (%)',
);

$NDecisionFields = 17;

for ($i = 0; $i < $NDecisionFields; ++$i) {
    $DecisionMap[$DecisionFields[$i]] = $DecisionNames[$i];
}



$ratcolormap = array(
    1000 => "rating1",
    1200 => "rating2",
    1400 => "rating3",
    1800 => "rating4",
    -1 => "rating5",
);

function updateConfig() {

    $db = new maniadb;
    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);
    $db->query("SELECT * FROM `Configuracao` WHERE 1");

    while ($row = $db->nextRow()) {
	$GLOBALS[$row['key']] = $row['value'];
    }

    $db->close();
}

updateConfig();

function setTimePageGen($timeElapsed) {
    $db = new maniadb;
    $db->connectCall($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);

    $timeElapsed = intval(1000 * $timeElapsed);

    $db->queryCall("CALL novoTempo($timeElapsed);");

    $db->close();
}

function updateInfo() {
    $id = -$_SESSION['Tipo cenario'];



    $db = new maniadb;
    $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
    $db->select($GLOBALS['mydb']);

    $db->query("SELECT * FROM `Informacoes` WHERE id = $id");

    $row = $db->nextRow();

    /* pesos das decisões */
    $GLOBALS['prand'] = 0.02;
    $GLOBALS['rand'] = $GLOBALS['prand'] * rand(0, 100) / 100.0;
    $GLOBALS['rand'] = $GLOBALS['prand'] = 0;

    $GLOBALS['Apreco'] = $row['Peso Preco'] * (1 + $GLOBALS['rand'] - $GLOBALS['prand'] * 0.5);
    $GLOBALS['Aprazo'] = $row['Peso Prazo'] * (1 + $GLOBALS['rand'] - $GLOBALS['prand'] * 0.5);
    $GLOBALS['Apropaganda'] = $row['Peso Propaganda'] * (1 + $GLOBALS['rand'] - $GLOBALS['prand'] * 0.5);
    $GLOBALS['APD'] = $row['Peso PD'] * (1 + $GLOBALS['rand'] - $GLOBALS['prand'] * 0.5);

    $GLOBALS['ValorTerreno'] = $row['Valor do terreno'];
    $GLOBALS['ValorMPEstoque'] = $row['Valor da materia-prima no estoque'] / 100;
    $GLOBALS['ValorMP'] = $row['Valor da materia-prima'];
    $GLOBALS['ValorPA'] = $row['Valor do produto acabado'];

    $GLOBALS['TaxaDemissao'] = $row['Taxa de demissao'] / 100;
    $GLOBALS['TaxaContratacao'] = $row['Taxa de contratacao'] / 100;
    $GLOBALS['ImpostosTotaisVenda'] = $row['Imposto totais de venda'] / 100;
    $GLOBALS['JurosCP'] = $row['Juros de curto prazo'] / 100;
    $GLOBALS['DesvalorizacaoHoraVenda'] = $row['Desvalorizacao da empresa na hora da venda'] / 100;
    $GLOBALS['PerdaPorMes'] = $row['Perda de eficiencia mensal das maquinas'] / 100;
    $GLOBALS['TaxaSelic'] = $row['Taxa Selic'] / 100;
    $GLOBALS['TaxaPoupanca'] = $row['Taxa de juros da poupanca'] / 100;
    $GLOBALS['TaxaJurosELP'] = $row['Taxa de juros dos emprestimos de longo prazo'] / 100;

    $GLOBALS['TempoFabricacao'] = $row['Tempo de fabricacao (horas)'];
    $GLOBALS['OperariosMaquina'] = $row['Operarios por maquina'];
    $GLOBALS['CapitalSocial'] = $row['Capital social'];
    $GLOBALS['ValorMaquinaNova'] = $row['Valor da maquina nova'];
    $GLOBALS['VidaUtil'] = $row['Vida util das maquinas'];
    $GLOBALS['ValorSucata'] = $row['Valor da sucata'];
    $GLOBALS['ValorPredialInicial'] = $row['Valor inicial dos predios'];

    $GLOBALS['CustoPorHoraFabricacao'] = $row['Custo por hora de fabricacao'];
    $GLOBALS['CustoFixoMensal'] = $row['Custo fixo mensal'];
    $GLOBALS['CustoEstoquePA'] = $row['Custo de armanezamento do produto acabado'];
    $GLOBALS['CustoEstoqueMP'] = $row['Custo de armanezamento da materia-prima'];
    $GLOBALS['Custohmanutencao'] = $row['Custo por hora de manutencao'];

    $GLOBALS['ValorHE'] = $row['Valor da hora extra'] / 100;
    $GLOBALS['EmprestimoMaximo'] = $row['Potencial de emprestimo de longo prazo'] / 100;
    $GLOBALS['ParcelaMinima'] = $row['Parcela minima'];
    $GLOBALS['MPNecessaria'] = $row['Materia Prima necessaria'];

    $GLOBALS['TaxaDeAmortizacao'] = $row['Taxa de amortizacao'] / 100;

    $GLOBALS['SalarioEstagiario'] = $row['Estagiario de engenharia'];
    $GLOBALS['SalarioSupervisorTurno'] = $row['Supervisor de turno'];
    $GLOBALS['SalarioEngA'] = $row['Engenheiro A'];
    $GLOBALS['SalarioEngB'] = $row['Engenheiro B'];
    $GLOBALS['SalarioEngC'] = $row['Engenheiro C'];


    $GLOBALS['SalarioEngenheiro'] = array(
	0 => $row['Engenheiro A'],
	1 => $row['Engenheiro B'],
	2 => $row['Engenheiro C']
    );


    $GLOBALS['EficienciaEngenheiro'] = array(
	0 => $row['EF Engenheiro A'] / 100,
	1 => $row['EF Engenheiro B'] / 100,
	2 => $row['EF Engenheiro C'] / 100
    );

    $GLOBALS['SalarioAdmA'] = $row['Administrador A'];
    $GLOBALS['SalarioAdmB'] = $row['Administrador B'];
    $GLOBALS['SalarioAdmC'] = $row['Administrador C'];

    $GLOBALS['SalarioAdministrador'] = array(
	0 => $row['Administrador A'],
	1 => $row['Administrador B'],
	2 => $row['Administrador C']
    );

    $GLOBALS['EficienciaAdministrador'] = array(
	0 => $row['EF Administrador A'] / 100,
	1 => $row['EF Administrador B'] / 100,
	2 => $row['EF Administrador C'] / 100
    );


    $GLOBALS['SalarioSecA'] = $row['Secretaria A'];
    $GLOBALS['SalarioSecB'] = $row['Secretaria B'];
    $GLOBALS['SalarioSecC'] = $row['Secretaria C'];

    $GLOBALS['SalarioSecretaria'] = array(
	0 => $row['Secretaria A'],
	1 => $row['Secretaria B'],
	2 => $row['Secretaria C']
    );

    $GLOBALS['EficienciaSecretaria'] = array(
	0 => $row['EF Secretaria A'] / 100,
	1 => $row['EF Secretaria B'] / 100,
	2 => $row['EF Secretaria C'] / 100
    );

    $GLOBALS['SalarioVendA'] = $row['Vendedor A'];
    $GLOBALS['SalarioVendB'] = $row['Vendedor B'];


    $SalarioVendedor = array(
	0 => $row['Vendedor A'],
	1 => $row['Vendedor B']
    );

    $ComissaoVendedor = array(
	0 => $row['EF Vendedor A'] / 100,
	1 => $row['EF Vendedor B'] / 100
    );

    $GLOBALS['ComissaoVendA'] = $row['EF Vendedor A'] / 100;
    $GLOBALS['ComissaoVendB'] = $row['EF Vendedor B'] / 100;

    $GLOBALS['SalarioMinimo'] = $row['Operario'];
    $GLOBALS['SalarioMinimo'] = $row['Salario minimo'];



    $db->close();
}

function logXManager($nameV) {
    $n = strlen($nameV);
    $name = "";
    for ($i = 0; $i < $n; ++$i) {
	switch ($nameV[$i]) {
	    case "\n":
		$name.='\n';
		break;
	    default:
		$name.=$nameV[$i];
		break;
	}
    }

    $fcall = "alert('" . $name . "', 'Xmaneger');";
    echo '<head><script type="text/javascript">';
    echo "function logXManager(){ $fcall }";
    echo "</script></head>";
    echo "<body";
    echo ' onload="logXManager()"></body>';
}
?>

