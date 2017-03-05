<?php
session_start();
if(isset($_POST['connex'])){
	$_SESSION['username'] = $_POST['userid'];
}
if(isset($_POST['deco'])){
	session_destroy();
	header("Refresh:0");
}
?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Paris dispo</title>
    <link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="js/menu.js"></script>

  </head>

  <body>
	<div id='header'>
        <a href="index.php"><img height="157" src="ulcobet.png" width="207" /></a>
		        <?php 
    if(isset($_SESSION['username'])){
    	echo "<h1 class='bonjour'>Bonjour, ".$_SESSION['username']."</h1>";
    	echo "<form action='parisencemoment.php' method='POST' class='formul'><button class='deco' name='deco'>Se deconnecter </button></form>";

    }
    
    
    
	if(!isset($_SESSION['username'])){   
    echo "<form action='parisencemoment.php' method='POST' class='formul'><input type='text' placeholder='Nom de compte' name='userid' id='userid' class='userid'/><input type='password' placeholder='Mot de passe' name='pass' id='pass' class='pass' /><button class='connex' name='connex'>Se connecter </button></form><a href='inscription.php'><button class='inscri' value='inscription.php' name='inscr'>Inscription </button></a>";
    }?>	</div>

<div class="container">
		<ul id="nav" class="myTopnav">
			<li><a></a></li>
			<li><a href="index.php">Accueil</a></li>
			<li><a href="parisencemoment.php">En ce moment</a>
			<?php 
    			if(isset($_SESSION['username'])){
					echo "<li><a href='parisresultats.php'>Resultats</a>";
					echo "<li><a href='mesparis.php'>Mes paris</a></li>";
				}
			?>
			<li><a href="contacts.php">Contact</a></li>
			<?php 
 			    if(isset($_SESSION['username'])){
					echo"<li><a href='creationpari.php'>Creer un pari</a></li>";
					echo"<li><a href='propositiongage.php'>Proposer un gage</a></li>";
				}
			?>			<li class="icon"><a href="javascript:void(0);" onclick="myFunction()">&#9776;</a></li>
		</ul>
</div>
<h1>Les Ulcobets :</h1>
    <h2>UlcoBet disponibles</h2><br>
    <div class="DG_UlcoBet_disponibles">
      <p>Description : </p>
      <br>
        
         <?php
require_once "tag.lib.php";
require_once "check.lib.php";

try{$base=new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
}catch(PDOException $error){ die($error->getMessage() );}

// comment differencier paris gagné / perdu , comment effectuer choix paris , description du pari ( new colonne )

$title="paris dispo";

$req="SELECT * FROM Pari WHERE Statut=0";

$body="<table>\n";

$css="style.css";


if(!$result=$base->query($req)) die("Probleme $req");

foreach($result as $row){
$Titre=$row['#Titre']."\t";
$Libelle=$row['#Libelle']."\t";
$DateDebut=$row['DateDebut']."\t";
$DateEcheance=$row['#DateEcheance']."\t";


$body.=row(cell($Titre).cell($Libelle).cell($DateDebut).cell($DateEcheance));

}

$body.="</table>\n";

require_once "template.php";

?>
        
        
        
        
        
        
        
      <p>Côte totale :</p>
      <p>Mise :</p>
      <p>Gains : <a href="roulette/roulette.php"> Roulette des gains</a></p>
    </div>
	<br>
	<div class="ecart">
	</div>
	 <h2>UlcoBet en cours</h2>
    <div class="DG_UlcoBet_encours">
      <p>[Description : ...]</p>
      <br>
      <p>Côte totale :</p>
      <p>Mise :</p>
      <p>Gains : <a href="roulette/roulette.php"> Roulette des gains</a></p>
    </div>
  </body>
</html>
