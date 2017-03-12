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
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title>Contacts</title>
    <link rel="icon" type="image/png" href="ulcobet.png"/>
    <link rel="stylesheet" href="style.css">
	
<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/script2.js"></script>
	<script type="text/javascript" src="js/menu.js"></script>
	
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
    echo "<form action='confidentialite.php' method='POST' class='formul'><input type='text' placeholder='Nom de compte' name='userid' id='userid' class='userid'/><input type='password' placeholder='Mot de passe' name='pass' id='pass' class='pass' /><button class='connex' name='connex'>Se connecter </button></form><a href='inscription.php'><button class='inscri' value='inscription.php' name='inscr'>Inscription </button></a>";
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
			?>			
			<li class="icon"><a href="javascript:void(0);" onclick="myFunction()">&#9776;</a></li>
		</ul>
</div>
<div id ="LG_contenu">
		<h1>Confidentialite</h1>
		  <div class ="LG_formucreapari">
				<form class="Formu" novalidate>
			    <label for="Titrepari"><p>Entrez votre ancien mot de passe:</p></label>
                <input type="text" placeholder="ancien mot de passe" id="LG_Titre" /></br></br>
	       		
			    <label for="datedebut"><p>Entrez votre nouveau mot de passe:</p></label>
			    <input type="text" placeholder="nouveau mot de passe" id="LG_ddf" /></br></br>
    
                <label for="datedebut"><p>Retapez votre nouveau mot de passe:</p></label>
			    <input type="text" placeholder="Verif' nouveau mot de passe" id="LG_ddf" /></br></br>
    
                

                <label for="datedebut"><p>Pour la sécurité de votre compte veuillez entre votre date de naissance:</p></label>
			    <input type="date" placeholder="date de naissance" id="LG_ddf" /></br></br></br>

                <div class ="LG_button">
			    <input  type="submit" value = "Enregistrer"/></br>
                </div>
				</form>
                

        </div>
	    </div>
	</div>
</body>
</html>