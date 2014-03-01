<?php

	function isInt($x) {
		$len = strlen($x);
		
		if ($len == 0) return false;
		
		for ($i = 0; $i < $len; ++$i) {
			if ($x[$i] < '0' or $x[$i] > '9') {
				return false;
			}
		}
		
		return true;
	}

	function toInt($x) {
		$n = 0;
		$len = strlen($x);
		
		for ($i = 0; $i < $len; ++$i) {
			$n = 10 * $n + ($x[$i] - '0');
		}
		
		return $n;
	}

?>