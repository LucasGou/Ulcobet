<?php
session_start();
try{$base=new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
}catch(PDOException $error){ die($error->getMessage() );}
if(isset($_POST['connex'])){
	
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
if(isset($_POST['accepter'])){
	$sth = $base->prepare("select * from Proposer_pari where `#IdPari` = ?");
	$sth->execute(array($_POST['accepter']));
	$select = $sth->fetchAll();
	
	foreach($select as $s){
		$sth2 = $base->prepare("INSERT INTO Pari(`#Titre`,`#Libelle`,DateDebut,`#DateEcheance`,choix1,choix2) values(?,?,?,?,?,?)");
		$sth2->execute(array($s['Titre'],$s['Libelle'],$s['DebutPari'],$s['DateFin'],$s['choix1'],$s['choix2']));

	}
	$sth2 = $base->prepare("UPDATE Proposer_pari SET Statut=1 where `#IdPari` = ?");
	$sth2->execute(array($_POST['accepter']));
	
	

}

if(isset($_POST['refuser'])){
	
	$sth2 = $base->prepare("UPDATE Proposer_pari SET Statut=-1 where `#IdPari` = ?");
	$sth2->execute(array($_POST['refuser']));
	

}
if(isset($_POST['souhait1']) && isset($_POST['envoires'])){
	$sth2 = $base->prepare("UPDATE Pari SET Resultat=? where IdPari = ?");
	$sth2->execute(array($_POST['souhait1'],$_POST['envoires']));
}
if(isset($_POST['souhait2']) && isset($_POST['envoires'])){
	$sth2 = $base->prepare("UPDATE Pari SET Resultat=? where IdPari = ?");
	$sth2->execute(array($_POST['souhait2'],$_POST['envoires']));
}
if(!isset($_POST['souhait2']) && !isset($_POST['souhait1']) && isset($_POST['envoires'])){
	echo "<script>alert('Veuillez choisir un resultat!')</script>";
}
if(isset($_POST['effectuergain'])){
	$sth2 = $base->prepare("UPDATE Attribuer_gain SET Statut=1 where IdAttribut = ?");
	$sth2->execute(array($_POST['effectuergain']));

}
if(isset($_POST['effectuergage'])){
	$sth2 = $base->prepare("UPDATE Attribuer_gage SET Statut=1 where IdAttribut = ?");
	$sth2->execute(array($_POST['effectuergage']));

}


?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Administration</title>
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
<h1>Administrer</h1>
    <br>
    <div class="DG_UlcoBet_disponibles">
      <h3>Paris proposes</h3>
      <br>
        
         <?php
if (isset($_SESSION['admin']) && $_SESSION['admin'] == "oui"){
require_once "tag.lib.php";
require_once "check.lib.php";
try{$base=new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
}catch(PDOException $error){ die($error->getMessage() );}
// comment differencier paris gagné / perdu , comment effectuer choix paris , description du pari ( new colonne )
$title="paris dispo";
$req="SELECT * FROM Proposer_pari where Statut = 0";
$body="<table>\n";
$css="style.css";
if(!$result=$base->query($req)) die("Probleme $req");
foreach($result as $row){
$Titre=$row['Titre']."\t";
$Libelle=$row['Libelle']."\t";
$DebutPari=$row['DebutPari']."\t";
$DateFin=$row['DateFin']."\t";
$ID = $row['#IdPari'];
    
    $accepter="<form action='administration.php' method='post'><button name='accepter' value=".$ID." class='accepter'>ACCEPTER</button></form>";
    $refuser="<form action='administration.php' method='post'><button name='refuser' value=".$ID." class='refuser'>REFUSER</button></form>";
    
$body.=row(cell($Titre).cell($Libelle).cell($DebutPari).cell($DateFin).cell($accepter).cell($refuser));
}
$body.="</table>\n";
require_once "template.php";}
?>
        
        
      
    </div>
    
    
    
    <div class="DG_UlcoBet_disponibles">
    <h3>Resultats</h3>
    <?php
    if (isset($_SESSION['admin']) && $_SESSION['admin'] == "oui"){
    try{$base=new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
}catch(PDOException $error){ die($error->getMessage() );}
	
	$sth = $base->prepare("select * from Pari where Resultat IS NULL");
	$sth->execute(array());
	$select = $sth->fetchAll();
	$body = "<table>";
	foreach($select as $s){
		$body.=row(cell($s['#Titre']).cell($s['#Libelle']).cell("<form action='administration.php' method='post'><div id='choixx'><input type='radio' name='souhait1' value=".$s['choix1']." id='choix11' />".$s['choix1']."<input type='radio' name='souhait2' value=".$s['choix2']." id='choix22' />".$s['choix2']."</div><button name='envoires' value=".$s['IdPari']." class='refuser'>Mettre Resultat à jour</button></form>",array("id"=>"choi1")));
	}
	$body.="</table>";
    echo $body;
}
    ?>
    
    </div>
    
	<br>
	
	<div class="DG_UlcoBet_disponibles">
    <h3>Gages</h3>
    <?php
    if (isset($_SESSION['admin']) && $_SESSION['admin'] == "oui"){
    try{$base=new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
}catch(PDOException $error){ die($error->getMessage() );}
	
	$sth = $base->prepare("select * from Attribuer_gage where Statut = 0");
	$sth->execute(array());
	$select = $sth->fetchAll();
	
	$body = "<table>";
	foreach($select as $s){
	
		$sth2 = $base->prepare("select * from Gage where IdGage = ?");
		$sth2->execute(array($s['IdGage']));
		$select2 = $sth2->fetchAll();
		
		foreach($select2 as $s2){
			$body.=row(cell($s2['LibelleGage']).cell($s['User']).cell("<form action='administration.php' method='post'><button name='effectuergage' value=".$s['IdAttribut']." class='refuser'>Effectuer</button></form>"));
		}

	
	
	
	
		
	}
	$body.="</table>";
    echo $body;
}
    ?>
    
    </div>
	<br />
	
	<div class="DG_UlcoBet_disponibles">
    <h3>Gains</h3>
    <?php
    if (isset($_SESSION['admin']) && $_SESSION['admin'] == "oui"){
    try{$base=new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
}catch(PDOException $error){ die($error->getMessage() );}
	
	$sth = $base->prepare("select * from Attribuer_gain where Statut = 0");
	$sth->execute(array());
	$select = $sth->fetchAll();
	
	$body = "<table>";
	foreach($select as $s){
	
		$sth2 = $base->prepare("select * from Gain where IdGain = ?");
		$sth2->execute(array($s['IdGain']));
		$select2 = $sth2->fetchAll();
		
		foreach($select2 as $s2){
			$body.=row(cell($s2['LibelleGain']).cell($s['User']).cell("<form action='administration.php' method='post'><button name='effectuergain' value=".$s['IdAttribut']." class='refuser'>Effectuer</button></form>"));
		}

	
	
	
	
		
	}
	$body.="</table>";
    echo $body;
}
    ?>
    
    </div>

  </body>
</html>