<?php	
	function tag($tag, $content="", $attributs=array(), $before ="", $after =""){
		
		$html = "$before";
		$html .= "<$tag ";
		foreach($attributs as $a => $v){

			$html .= "$a= '$v' ";
	
		}
	
		$html .= ">$content";
		if ($content != ""){
		$html .= "</$tag>"; }
		$html .= "$after";

		return $html;

	}


	function paragraphe($content2="", $attributs2=array()){
	
		$paragraph = tag("p", $content2, $attributs2);

		return $paragraph;	
	
	}

	function formulaire($content3="",$action="#", $method="post", $attributss3=array()){

		$attributsspec = array("method" => $method, "action" => $action);
		$attributs3 = array_merge($attributsspec, $attributss3);
		$formu = tag("form", $content3, $attributs3);
	
		return $formu;	
	
	}

	function inputt($name, $type="text", $value="", $before2 ="", $after2 ="", $attributss4=array()){
	
		$attributsspec2 = array("name" => $name, "type" => $type, "value" => $value);
		$attributs4 = array_merge($attributsspec2, $attributss4);
		$input = tag("input", "", $attributs4, $before2, $after2);

		return $input;	
	
	}

	function table($contenttable){
	
		$tablo = tag("table", $contenttable);
	
		return $tablo;

	}

	function row($contentrow){
	
		$ligne = tag("tr", $contentrow);

		return $ligne;

	}

	function cell($contentcell){
	
		$cellule = tag("td", $contentcell);
	
		return $cellule;

	}

	function select($options=array(), $optionsattr=array(), $attributsselect=array()){
		$compteur = 0;
		$contentsel = "";

		foreach($options as $a){
			$attroptions = array("value" => $optionsattr[$compteur]);
			$contentsel .= tag("option", $a, $attroptions);
			$compteur++;

		}

		$selection = tag("select", $contentsel, $attributsselect);

		return $selection;

	}

?>
