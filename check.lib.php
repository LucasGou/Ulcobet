<?php
	
	$ERROR = array("Pas d'erreur", "Chaine trop courte", "Chaine trop longue", "Ne correspond pas à un entier", "Trop petit", "Trop grand", "Pas un string", "...");

	function check_string($argu, $min='0', $max='100'){

		if (!is_numeric($argu)){

			$a = strlen($argu);

			if ($a < $min){
				return 1;
			}
			else if ($a > $max){
				return 2;
			}
			else{
				return 0;
			}
		}
		else{
			return 6;
		}
	}

	function check_integer($argu2, $min2='0', $max2='100'){

		if (is_numeric($argu2)){

			if ($argu2 < $min2){
				return 4;
			}
			else if ($argu2 > $max2){
				return 5;
			}
			else{
				return 0;
			}
		}
		else{
			return 3;
		}
	}

	function check_enum($arg3, $nomt=array()){
		$c = 0;
		foreach($nomt as $b){
		if ($b == $arg3){
			return "trouv&eacute;";
			$c = 1;
		}}
		if ($c == 0){
			return "non trouv&eacute;";
		}
	}
?>
