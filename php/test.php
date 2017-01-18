<?php
require_once "tag.lib.php";
require_once "check.lib.php";
try{
$base=new PDO('pgsql:host=localhost;dbname=m3106','becquet.maxime','handball');
}catch(PDOException $error){ die($error->getMessage() );}



$title="Base mes gains";





$req="SELECT * FROM etudiants";

$body.="<table>\n";

$css="base.css";


if(!$result=$base->query($req, PDO::FETCH_ASSOC)) die("Probleme $req");

foreach($result as $row){

$nom=$row['nom']."\t";
$note= $row['note']."\t";

$body.=row(cell($nom).cell($note));

}

$body.="</table>\n";

require_once "template.php";

?>
