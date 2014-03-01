<?php

class maniadb {
	var $link;
	var $result;
    var $data;
    var $ip;
    var $nd;
    var $loadData;
	function maniadb() {
        $this->result = $this->link= 0;
    }

	function connect($PATH, $USR, $PWD){
        $this->result = 0;
		$this->link = mysql_connect($PATH, $USR, $PWD);
		if (!$this->link) {
			die('Não foi possível conectar: ' . mysql_error());
		}
	}
	
	function select($DB){
		if (!mysql_select_db($DB, $this->link)) {
			logXManager('Não foi possível selecionar o banco de dados');
			die("Data base ocupado por favor recarregue\n");
		}
	}

    function connectCall($PATH, $USR, $PWD){
        $this->result = 0;
		$this->link = mysql_connect($PATH, $USR, $PWD, true, 131072);
		if (!$this->link) {
			die('Não foi possível conectar: ' . mysql_error());
		}
	}

    function queryCall($SQL) {
        
        $this->result = mysql_query($SQL, $this->link);

		if (!$this->result) {
            echo mysql_error();
			logXManager("Erro do banco de dados, não foi possível consultar o banco de dados\n". mysql_error());
			return false;
		}
        
        return true;
    }

    function queryNoBatch($SQL) {
        $this->result = mysql_query($SQL, $this->link);

		if (!$this->result) {
            
            echo mysql_error();
			logXManager("Erro do banco de dados, não foi possível consultar o banco de dados\n". mysql_error());
			return false;
		}
        
        return true;
    }
	
	function query($SQL){
        $this->result = mysql_query($SQL, $this->link);

		if (!$this->result) {
            
            echo mysql_error();
			logXManager("Erro do banco de dados, não foi possível consultar o banco de dados\n". mysql_error());
			return false;
		}
        
        $this->data = array();
		$this->ip = $this->nd = 0;
        $this->loadData = false;
        
            
		return true;
	}
	
	function nextRow() {
        if (!$this->loadData) {
            while ($d = mysql_fetch_assoc($this->result)) {
                $this->data[$this->nd] = $d; $this->nd++;
            }
            $this->loadData = true;
            mysql_free_result($this->result);
        }

        $v = 0;
        if ($this->ip < $this->nd) {
            $v = $this->data[$this->ip];
            $this->ip++;
        }
    
        return $v;
	}
	
	function free() {
        $this->data = array();
	}
	
	function close() {
        $this->free();
        mysql_close($this->link);
	}
};

function getQueryUpdate($db, $v, $idDb) {
    $query = "UPDATE `$db` SET ";

    $f = true;
    foreach ($v as $key => $value)
        if (strcmp($key, 'id') != 0) {
            if (!$f) {
                $query .=", "; 
            } else {
                $f = false;
            }

            $query .= "`$key` = '$value'";
        }

    $query .= " WHERE id = $idDb";
    return $query;
}

function getQueryInsert($db, $v) {
    

    $query = "INSERT INTO `$db` (";
    $f = true;
    foreach ($v as $key => $value) {
        if (strcmp($key, 'id') != 0) {        
            if ($f) {
                $query .= '`'.$key.'`'; 
                $f = false;
            } else {
                $query .= ", `".$key.'`';
            }
        }
    }

    $query .=") VALUES(";

    $f = true;
    foreach ($v as $key => $value) {
        if (strcmp($key, 'id') != 0) {                
            if ($f) {
                $query .= $value; 
                $f = false;
            } else {
                $query .= ", ".$value;
            }
        }
    }
    $query .= ")";
    return $query;
}
function parser($str) {
    $n = strlen($str);

    for ($i = 0; $i < $n; ++$i) {
        $ok = false;
        if (($str[$i] >= 'A' and $str[$i] <= 'Z') or
            ($str[$i] >= 'a' and $str[$i] <= 'z') or
            ($str[$i] >= '0' and $str[$i] <= '9') or
            $str[$i] == '.' or $str[$i] == '_' or
            $str[$i] == ' ' or $str[$i] == '+' or
            $str[$i] == '-') {
            $ok = true;
        }
        if (!$ok) return false;
    }

	
	return true;
}

function inputValidation() {

    foreach ($_POST as $key => $value) {
        if (!parser($value) and strcmp($key,'f') and strcmp($key,'salvarDecisao')) {
            logXManager($value." é uma entrada inválida!\n");
            return false;
        }
	}

    foreach ($_GET as $key => $value) {
        if (!parser($value) and strcmp($key,'f') and strcmp($key,'salvarDecisao')) {
            logXManager($value." é uma entrada inválida!\n");
            return false;
        }
	}

    return true;
}

?>
