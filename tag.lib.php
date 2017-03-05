<?php
function tag($tag, $content=null,$attributs=array(),$after ='',$before=''){
	
	$str_att='';
	foreach($attributs as $key =>$value){
	$str_att .= " $key =\"$value\" ";
									 	}
	
	if($content)return "$before<$tag$str_att>$content</$tag>$after";
	else return "$before<$tag$str_att/>$after";
	
}	                                                                    	


function form($content,$method="POST",$action='#',$attributs=array()){

$attributs['method']=$method;
$attributs['action']=$action;
return tag('form',$content,$attributs);
}



function paragraphe($content,$attributs=array()){
return tag('p',$content,$attributs,"\n");
}

function entete($content,$attributs=array()){
return tag('h2',$content,$attributs);
}							

function image($name,$attributs=array(),$directory='Images'){
	$attributs['src']=$name ;
	return tag('Images',null,$attributs);
	}

function hcell($content,$attributs=array()){
return tag('td',$content,$attributs);
}

function cell($content,$attributs=array()){
return tag('th',$content,$attributs);
}

function row($content,$attributs=array()){
return tag('tr',$content,$attributs);
}

function table($content,$attributs=array()){
return tag('table',$content,$attributs);
}
														
?>
