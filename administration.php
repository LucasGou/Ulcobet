<?php
session_start();
if(isset($_POST['connex'])){
	try{$base=new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
}catch(PDOException $error){ die($error->getMessage() );}

$sth = $base->prepare('select * from Utilisateur');
$sth->execute(array());
$select = $sth->fetchAll();
$users = 0;
foreach($select as $s){
	if(($s["Pseudo"] == $_POST['userid']) && ($s["Mot_de_passe"] == $_POST['pass'])){
	$_SESSION['username'] = $_POST['userid'];
	$users = 1;
	}
	
}
	if($users==0){
	echo "<script>";
	echo "alert('Veuillez rentrer un Pseudo ou mot de passe valide')";
	echo "</script>";
}

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
			
			<?php 
    			if(isset($_SESSION['username'])){
    			echo "<li><a href='parisencemoment.php'>En ce moment</a>";
					echo "<li><a href='parisresultats.php'>Resultats</a>";
					echo "<li><a href='mesparis.php'>Mes paris</a></li>";
				}
			?>
			<li><a href="contacts.php">Contact</a></li>
			<?php 
 			    if(isset($_SESSION['username'])){
					echo"<li><a href='creationpari.php'>Creer un pari</a></li>";
					echo"<li><a href='propositiongage.php'>Proposer un gage</a></li>";
					echo"<li><a href='moncompte.php'>Mon Compte</a></li>";
				}
			?>			<li class="icon"><a href="javascript:void(0);" onclick="myFunction()">&#9776;</a></li>
		</ul>
</div>
<h1>Administrer</h1>
    <br>
    <div class="DG_UlcoBet_disponibles">
      
      <br>
        
         <?php
require_once "tag.lib.php";
require_once "check.lib.php";
try{$base=new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
}catch(PDOException $error){ die($error->getMessage() );}
// comment differencier paris gagné / perdu , comment effectuer choix paris , description du pari ( new colonne )
$title="paris dispo";
$req="SELECT * FROM Proposer_pari";
$body="<table>\n";
$css="style.css";
if(!$result=$base->query($req)) die("Probleme $req");
foreach($result as $row){
$Titre=$row['Titre']."\t";
$Libelle=$row['Libelle']."\t";
$DebutPari=$row['DebutPari']."\t";
$DateFin=$row['DateFin']."\t";

    
    $accepter="<form action='#' method='post'><button name='accepter' value='' class='accepter'>ACCEPTER</button></form>";
    $refuser="<form action='#' method='post'><button name='refuser' value='' class='refuser'>REFUSER</button></form>";
    
$body.=row(cell($Titre).cell($Libelle).cell($DebutPari).cell($DateFin).cell($accepter).cell($refuser));
}
$body.="</table>\n";
require_once "template.php";
?>
        
        
        
        
        
        
        
      
    </div>
	<br>
	
  </body>
</html>