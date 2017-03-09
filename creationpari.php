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
	<title>Contacts</title>
    <link rel="icon" type="image/png" href="ulcobet.png"/>
    <link rel="stylesheet" href="style.css">
	
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="script2.js"></script>
	<script type="text/javascript" src="menu.js"></script>

</head>
<body>
	<div id='header'>
        <a href="index.php"><img height="157" src="ulcobet.png" width="207" /></a>
		        <?php 
    if(isset($_SESSION['username'])){
    	echo "<h1 class='bonjour'>Bonjour, ".$_SESSION['username']."</h1>";
    	echo "<form action='creationpari.php' method='POST' class='formul'><button class='deco' name='deco'>Se deconnecter </button></form>";

    }
    
    
    
	if(!isset($_SESSION['username'])){   
    echo "<form action='creationpari.php' method='POST' class='formul'><input type='text' placeholder='Nom de compte' name='userid' id='userid' class='userid'/><input type='password' placeholder='Mot de passe' name='pass' id='pass' class='pass' /><button class='connex' name='connex'>Se connecter </button></form><a href='inscription.php'><button class='inscri' value='inscription.php' name='inscr'>Inscription </button></a>";
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

$body="<form method='POST' action=Creationpari.php>\n";
$body.=entete('Proposer votre pari');

$body.="<label for='Titre'><h5>Titre du pari</h5></label>";
$body.="<input type text='text' name='Titre' placeholder='Titre du paris'>";
$body.="</br>";
$body.="</br>";

              
              $body.="<label for='Libelle'><h5>Description du pari</h5></label>";
$body.="<textarea text='Libelle' id='Libelle' name='Libelle' placeholder='Ecrivez une description complete et precise de votre pari (mise en jeu, adversaire, categorie, ...)' rows='10' cols='70'></textarea>"; 
$body.="</br>";
$body.="</br>";
              
$body.="<input type='date' id='dated' name='datedebut' placeholder='aaaa/mm/jj'>";
$body.="<input type='date' id='datef' name='datefin' placeholder='aaaa/mm/jj'>"; 

$body.="</br>";
$body.="</br>";
$body.="</br>";

$body.="<input  type='submit' value = 'Proposer aux admins'/>";
$body.="</br>";
$body.="</br>";
$body.="</form>";
        
        $req="SELECT * FROM Proposer_pari";
        $body.="<table>\n";
        $css="style.css";

if((isset($_POST['Titre'])!=NULL)&&(isset($_POST['Libelle'])!=NULL)&&(isset($_POST['datedebut'])!=NULL)&&(isset($_POST['datefin'])!=NULL)){
$sqll="INSERT INTO Proposer_pari(Titre,Libelle,DebutPari,DateFin) VALUES(lower('{$_POST['Titre']}'),lower('{$_POST['Libelle']}'),lower('{$_POST['datedebut']}'),lower('{$_POST['datefin']}'));";
if(!$affected_rows=$base->exec($sqll)) die(" Erreur : $sqll "); 

}
 
        
if(!$result=$base->query($req, PDO::FETCH_ASSOC)) die("Probleme $req");


     $body.="</table>\n";

         
        if(($_POST['Titre']!=NULL)&&($_POST['Libelle']!=NULL)&&($_POST['datedebut']!=NULL)&&($_POST['datefin']!=NULL)){
        echo "<script>alert(\"PROPOSITION VALIDE\")</script>";  
        }
              
        if(($_POST['Titre']==NULL)||($_POST['Libelle']==NULL)||($_POST['datedebut']==NULL)||($_POST['datefin']==NULL)){
        echo "<script>alert(\"PROPOSITION NON VALIDE IL MANQUE UN RENSEIGNEMENT\")</script>";  
        }


         
require_once "template.php";

?>

















	    </div>
	
</body>
</html>
