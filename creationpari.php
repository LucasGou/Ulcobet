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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title>Contacts</title>
    <link rel="icon" type="image/png" href="ulcobet.png"/>
    <link rel="stylesheet" href="style.css">
	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/script2.js"></script>
	<script type="text/javascript" src="js/temps.js"></script>

	<script type="text/javascript" src="js/menu.js"></script>

</head>
<body>
	<div id='header'>
        <a href="index.php"><img height="157" src="ulcobet.png" width="207" /></a>
		        <?php 
    if(isset($_SESSION['username'])){
    	echo "<h1 class='bonjour'>Bonjour, ".$_SESSION['username']."</h1>";
    	echo "<form action='creationpari.php' method='POST' id='formul'><button class='deco' name='deco'>Se deconnecter </button></form>";

    }
    
    
    
	if(!isset($_SESSION['username'])){   
    echo "<form action='creationpari.php' method='POST' id='formul'><input type='text' placeholder='Nom de compte' name='userid' id='userid' class='userid'/><input type='password' placeholder='Mot de passe' name='pass' id='pass' class='pass' /><button class='connex' name='connex'>Se connecter </button></form><a href='inscription.php'><button class='inscri' value='inscription.php' name='inscr'>Inscription </button></a>";
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

			?>			
			<li class="icon"><a href="javascript:void(0);" onclick="myFunction()">&#9776;</a></li>
		</ul>
</div>
		<h1>Creation de  pari</h1>
		  <div class ="LG_formucreapari">
		  
<?php 
        
        
        require_once "tag.lib.php";
        require_once "check.lib.php";
              
              
              
try{$base=new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
}catch(PDOException $error){ die($error->getMessage() );}

$body="<form method='POST' action=creationpari.php>\n";
$body.=entete('Proposer votre pari');

$body.="<label for='Titre'><h5>Titre du pari</h5></label>";
$body.="<input type text='text' name='Titre' placeholder='Titre de votre paris'><br />";
$body.="</br>";
$body.="<label for='Titre'><h5>Choix des parieurs</h5></label>";
$body.="<input type text='text' name='choix1' placeholder='choix 1'>";
$body.="<input type text='text' name='choix2' placeholder='choix 2' class='formudroite'><br />";
$body.="</br>";
$body.="<label for='Titre'><h5>Date de debut et fin du pari</h5></label>";
$body.="<input type='date' id='dated' name='datedebut'>";
$body.="<input type='date' id='datef' name='datefin' class='formudroite'>"; 


$body.="</br>";
$body.="</br>";

              
              $body.="<label for='Libelle'><h5>Description du pari</h5></label>";
$body.="<textarea text='Libelle' id='Libelle' name='Libelle' placeholder='Ecrivez une description complete et precise de votre pari (mise en jeu, adversaire, categorie, ...)' rows='10' cols='70'></textarea>"; 
$body.="</br>";
$body.="</br>";


$body.="<input  type='submit' value = 'Proposer aux admins'/>";
$body.="</br>";
              $body.="</br>";
$body.="</form>";
        
        $req="SELECT * FROM Proposer_pari";
        $body.="<table>\n";
        $css="style.css";

if((isset($_POST['Titre'])!=NULL)&&(isset($_POST['Libelle'])!=NULL)){
		$sth2 = $base->prepare("INSERT INTO Proposer_pari(Titre,Libelle,DebutPari,DateFin,choix1,choix2) values(?,?,?,?,?,?)");
		$sth2->execute(array($_POST['Titre'],$_POST['Libelle'],$_POST['datedebut'],$_POST['datefin'],$_POST['choix1'],$_POST['choix2']));

}
 
        


     $body.="</table>\n";

         
       /* if(($_POST['Adresse_email']!=NULL)&&($_POST['Nom']!=NULL)&&($_POST['Prenom']!=NULL)&&($_POST['Pseudo']!=NULL)&&($_POST['Mot_de_passe']!=NULL)){
        header ('location: accueil.html'); 
      //  echo '<script language="javascript">alert("INSCRIPTION OK");</script>';   AFFICHER POPUP POUR PREVENIR INSCRIPTION OK
        }*/


         
require_once "template.php";

?>

















	    </div>
	
</body>
</html>
