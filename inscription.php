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
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel='stylesheet' href='style.css'>
	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/script2.js"></script>
	<script type="text/javascript" src="js/menu.js"></script>
	
	<title>Inscription</title>
</head>
<body>
	<div id='header'>
        <a href="index.php"><img height="157" src="ulcobet.png" width="207" /></a>
		        <?php 
    if(isset($_SESSION['username'])){
    	echo "<h1 class='bonjour'>Bonjour, ".$_SESSION['username']."</h1>";
    	echo "<form action='confidentialite.php' method='POST' class='formul'><button class='deco' name='deco'>Se deconnecter </button></form>";

    }
    
    
    
	if(!isset($_SESSION['username'])){   
    echo "<form action='confidentialite.php' method='POST' class='formul'><input type='text' placeholder='Nom de compte' name='userid' id='userid' class='userid'/><input type='password' placeholder='Mot de passe' name='pass' id='pass' class='pass' /><button class='connex' name='connex'>Se connecter </button><button class='inscri' value='inscription.php' name='inscr'>Inscription </button></form>";
    }?>	</div>

	<div class="container">
		<ul id="nav" class="myTopnav">
			<li><a></a></li>
			<li><a href="index.php">Accueil</a></li>
			<li><a href="parisencemoment.php">En ce moment</a>
			<?php 
    			if(isset($_SESSION['username'])){
					echo "<li><a href='parisresultats.php'>RÃ©sultats</a>";
					echo "<li><a href='mesparis.php'>Mes paris</a></li>";
				}
			?>
			<li><a href="contacts.php">Contact</a></li>
			<?php 
 			    if(isset($_SESSION['username'])){
					echo"<li><a href='creationpari.php'>CrÃ©er un pari</a></li>";
					echo"<li><a href='propositiongage.php'>Proposer un gage</a></li>";
				}
			?>			
			<li class="icon"><a href="javascript:void(0);" onclick="myFunction()">&#9776;</a></li>
		</ul>
</div>
    
    <div id="MB_Contenu">
        <h1>Formulaire d'inscription</h1>
        <br/>
     <div class="MBInscription">
                    <?php 
        
        
        require_once "tag.lib.php";
require_once "check.lib.php";
try{$base=new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
}catch(PDOException $error){ die($error->getMessage() );}

            $body="<form method='POST' action=Inscription.php>\n";
$body.=entete('Inscription');

$body.="<label for='Adresse_email'><h5>Adresse_email</h5></label>";
$body.="<input type text='text' name='Adresse_email' placeholder='mamamamame@exemple.com'>";
$body.="</br>";
$body.="<label for='Nom'><h5>Nom</h5></label>";
$body.="<input type text='text' name='Nom' placeholder='dupont'>";
$body.="</br>";
$body.="<label for='Prenom'><h5>Prenom</h5></label>";
$body.="<input type text='text' name='Prenom' placeholder='Jean'>";
$body.="</br>";
$body.="<label for='Pseudo'><h5>Pseudo</h5></label>";
$body.="<input type text='text' name='Pseudo' placeholder='Djean'>";
$body.="</br>";
$body.="<label for='Mot_de_passe'><h5>Mot de passe</h5></label>";
$body.="<input type text='Mot_de_passe' name='Mot_de_passe'>";
$body.="</br>";  
$body.="<input type=submit value='Inscription'>";
$body.="</br>";
$body.="</form>";
        
        $req="SELECT * FROM Utilisateur";
         
         $css="style.css";
        
if((isset($_POST['Adresse_email'])!=NULL)&&($_POST['Nom']!=NULL)&&($_POST['Prenom']!=NULL)&&($_POST['Mot_de_passe']!=NULL)&&($_POST['Pseudo']!=NULL)){
$sqll="INSERT INTO Utilisateur(Adresse_email,Nom,Prenom,Pseudo,Mot_de_passe) VALUES(lower('{$_POST['Adresse_email']}'),lower('{$_POST['Nom']}'),lower('{$_POST['Prenom']}'),lower('{$_POST['Pseudo']}'),lower('{$_POST['Mot_de_passe']}'));";
if(!$affected_rows=$base->exec($sqll)) die(" Erreur : $sqll "); 

}
 
        
if(!$result=$base->query($req, PDO::FETCH_ASSOC)) die("Probleme $req");
/*
foreach($result as $row){

$IdUser=$row['IdUser']."\t";
$Adresse_email=$row['Adresse_email']."\t";    
$Nom= $row['Nom']."\t";
$Prenom=$row['Prenom']."\t";
$Pseudo=$row['Pseudo']."\t";
$Mot_de_passe= $row['Mot_de_passe']."\t";
} */
     

         
        if((isset($_POST['Adresse_email'])!=NULL)&&($_POST['Nom']!=NULL)&&($_POST['Prenom']!=NULL)&&($_POST['Pseudo']!=NULL)&&($_POST['Mot_de_passe']!=NULL)){
        header ('location: ../Accueil/accueil.html');
      //  echo '<script language="javascript">alert("INSCRIPTION OK");</script>';   AFFICHER POPUP POUR PREVENIR INSCRIPTION OK
        }

            
         
         
         
         
         
         
         
   

?>        
        </div>
         </div>
        



</body>
 
</html>

			