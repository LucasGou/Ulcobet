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

if(isset($_POST['choix1']) || isset($_POST['choix2'])){
	$choixenvoi = 1;
	if(isset($_POST['choix1'])){
	$choix = 1;
	}
	if(isset($_POST['choix2'])){
	$choix = 2;
	}
}

if(!isset($_POST['choix1']) && !isset($_POST['choix2'])){
	$choixenvoi = 0;
}





?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Paris dispo</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/temps.js"></script>

		<script type="text/javascript" src="js/menu.js"></script>

  </head>

  <body>
	<div id='header'>
        <a href="index.php"><img height="157" src="ulcobet.png" width="207" /></a>
		        <?php 
    if(isset($_SESSION['username'])){
    	echo "<h1 class='bonjour'>Bonjour, ".$_SESSION['username']."</h1>";
    	echo "<form action='parisencemoment.php' method='POST' id='formul'><button class='deco' name='deco'>Se deconnecter </button></form>";
    }
    
    
    
	if(!isset($_SESSION['username'])){   
    echo "<form action='parisencemoment.php' method='POST' id='formul'><input type='text' placeholder='Nom de compte' name='userid' id='userid' class='userid'/><input type='password' placeholder='Mot de passe' name='pass' id='pass' class='pass' /><button class='connex' name='connex'>Se connecter </button></form><a href='inscription.php'><button class='inscri' value='inscription.php' name='inscr'>Inscription </button></a>";
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
				if(isset($_SESSION['admin'])){
					if($_SESSION['admin']=="oui"){
						echo "<li><a href='administration.php'>Administrer</a></li>";
					}
				}

			?>			<li class="icon"><a href="javascript:void(0);" onclick="myFunction()">&#9776;</a></li>
		</ul>
</div>
 <?php
 
      require_once "tag.lib.php";
require_once "check.lib.php";
try{$base=new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
}catch(PDOException $error){ die($error->getMessage() );}

if($choixenvoi==1){

$sth = $base->prepare("insert into Participer_pari(IdPari,PseudoUser,choix) values(?,?,?)");
$sth->execute(array($_SESSION['idpari'],$_SESSION['username'],$choix));
echo "<h2>Choix enregistré, cliquez <a href='parisencemoment.php'>ICI</a> pour retourner a la page des paris.</h2>";

}




if(isset($_POST['idpar']) && $choixenvoi==0){
 	$_SESSION['idpari'] = $_POST['idpar'];
$sth = $base->prepare('select * from Pari where IdPari = ?');
$sth->execute(array($_POST['idpar']));
$select = $sth->fetchAll();

foreach($select as $s){
	$Choix1 = $s['choix1'];
	$Choix2 = $s['choix2'];
	$libelle = $s['#Libelle'];
}
echo "<h2>".$libelle."</h2>";
// comment differencier paris gagné / perdu , comment effectuer choix paris , description du pari ( new colonne )
$title="Choix resultat du pari";
      $body="<div id='choix'>";
      $body.="<form action='choix.php' method='post' id='choixform'>";
      $body.="<button name='choix1' value='1' class='choix' id='choix1'>".$Choix1."</button>";
      $body.="<button name='choix2' value='2' class='choix' id='choix2'>".$Choix2."</button>";
      $body.="</form>";
      $body.="</div>";
      require_once "template.php";
      
      }
?>

</body>
</html>