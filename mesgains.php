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
	if($s['Role']=="2"){
	$_SESSION['admin']="oui";
	}
	if($s['Role']=="1"){
	$_SESSION['admin']="non";
	}

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
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel='stylesheet' href='style.css'>
         <script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/temps.js"></script>

	<script type="text/javascript" src="js/menu.js"></script>

	
	<title>Mes Gains</title>
</head>
<body>
	<div id='header'>
        <a href="index"><img height="157" src="ulcobet.png" width="207" /></a>
		        <?php 
    if(isset($_SESSION['username'])){
    	echo "<h1 class='bonjour'>Bonjour, ".$_SESSION['username']."</h1>";
    	echo "<form action='index.php' method='POST' id='formul'><button class='deco' name='deco'>Se deconnecter </button></form>";

    }
    
    
    
	if(!isset($_SESSION['username'])){   
    echo "<form action='mesgains.php' method='POST' id='formul'><input type='text' placeholder='Nom de compte' name='userid' id='userid' class='userid'/><input type='password' placeholder='Mot de passe' name='pass' id='pass' class='pass' /><button class='connex' name='connex'>Se connecter </button></form><a href='inscription.php'><button class='inscri' value='inscription.php' name='inscr'>Inscription </button></a>";
    }?>
	</div>

<div class="container">
		<ul id="nav" class="myTopnav">
			<li><a></a></li>
			<li><a href="index.php">Accueil</a></li>
			
			<?php 
    			if(isset($_SESSION['username'])){
    			echo "<li><a href='parisencemoment.php'>En ce moment</a>";
					echo "<li><a href='parisresultats.php'>Résultats</a>";
					echo "<li><a href='mesparis.php'>Mes paris</a></li>";
				}
			?>
			<li><a href="contacts.php">Contact</a></li>
			<?php 
 			    if(isset($_SESSION['username'])){
					echo"<li><a href='creationpari.php'>Créer un pari</a></li>";
					echo"<li><a href='propositiongage.php'>Proposer un gage</a></li>";
					echo"<li><a href='moncompte.php'>Mon Compte</a></li>";
				}
				if(isset($_SESSION['admin'])){
					if($_SESSION['admin']=="oui"){
						echo "<li><a href='administration.php'>Administrer</a></li>";
					}
				}

			?>			
			<li class="icon"><a href="javascript:void(0);" onclick="myFunction()">&#9776;</a></li>
		</ul>
</div>

    <div id="MBContenuMesGages">
        <h1>Mes gains</h1><br/>
        <div class="MBMesGages">
    
    
    
            <p> Voici un tableau récapitulant vos gains obtenus suite à des paris gagnés.
            </p>
            <br /><br />
              <?php
require_once "tag.lib.php";
require_once "check.lib.php";

try{$base=new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
}catch(PDOException $error){ die($error->getMessage() );}

// Inscription , ulcobet , resultat , mes paris 

$sth = $base->prepare('select * from Attribuer_gain where User = ?');
$sth->execute(array($_SESSION['username']));
$select = $sth->fetchAll();

 
$body = "<table>";

foreach($select as $row){

$sth2 = $base->prepare('select * from Gain where IdGain = ?');
$sth2->execute(array($row['IdGain']));
$select2 = $sth2->fetchAll();

foreach($select2 as $row2){

$LibelleGain = $row2['LibelleGain'];

}

$Statut=$row['Statut'];

if($Statut==0){
$Stat = "Non effectué";
}
else{
$Stat = "Effectué";
}


$body.=row(cell($LibelleGain).cell($Stat));

}

$body.="</table>\n";

require_once "template.php";

?>
<br /><br />
<p>Chaque gain sera automatiquement validé par un admin et effectué sous 1 semaine</p>
        </div>
    </div>
    
</body>
 
</html>