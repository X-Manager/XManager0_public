<?php

//==============================================================//
/*
  $SA = 1 se vencer, 0.5 se empatar e 0 se perder
  Calcula no rating para o A
 */
function ELO($RA, $RB, $K, $SA) {
    $EA = 1 / (1 + pow(10, ($RB - $RA) / 400));

    return $RA + $K * ($SA - $EA);
}

//==============================================================//
//==============================================================//
/*
  Atualiaza o rating de R com base no resultado da rodada
 */
function ELO_novo_rating($R, $Rwin, $Rlose, $Rdraw, $K) {

    $racc = 0;
    $c = 0;

    foreach ($Rwin as $v) {
	$racc += ELO($R, $v, $K, 1);
	++$c;
    }

    foreach ($Rdraw as $v) {
	$racc += ELO($R, $v, $K, 0.5);
	++$c;
    }

    foreach ($Rlose as $v) {
	$racc += ELO($R, $v, $K, 0);
	++$c;
    }

    return $racc / $c;
}

//==============================================================//

/*
  Calcula novos ratings pra cada jogador no ranking com base em sua posi��o
 */
function ELO_novos_ratings($ranking, $np, $K) {
    for ($i = 0; $i < $np; ++$i) {

	$win = array();
	$lose = array();
	$draw = array();

	for ($j = 0; $j < $i; ++$j) {
	    $lose[$j] = $ranking[$j];
	}

	$k = 0;
	for ($j = $i + 1; $j < $np; ++$j) {
	    $win[$k] = $ranking[$j];
	    ++$k;
	}

	$nR[$i] = ELO_novo_rating($ranking[$i], $win, $lose, $draw, $K);
    }

    return $nR;
}

?>
