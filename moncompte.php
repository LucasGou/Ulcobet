<?php
session_start();
if(isset($_POST['connex'])){
	try{
		$base=new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
	}
	catch(PDOException $error){ 
		die($error->getMessage() );
	}

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

if(isset($_POST['changepseudo']) && isset($_POST['pseudo'])){
	try{
		$base=new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
	}
	catch(PDOException $error){ 
	die($error->getMessage() );
	}
			$dispo = 1;
			$sth = $base->prepare('select * from Utilisateur');
			$sth->execute(array());
			$select = $sth->fetchAll();
			foreach($select as $s){
				if(($s["Pseudo"] == $_POST['pseudo']) || $_POST['pseudo'] == ''){
				$dispo = 0;
				}
			}
			if($dispo==0){
			echo "<script>alert('Ce pseudo est deja utilisé ou vide, veuillez en choisir un autre')</script>";
			}
			else{
			$sth = $base->prepare('UPDATE Utilisateur SET pseudo = ? where pseudo=?');
			$sth->execute(array($_POST['pseudo'],$_SESSION['username']));
			$_SESSION['username']=$_POST['pseudo'];
			echo "<script>alert('modification effectuée')</script>";
			}
}


if(isset($_POST['changemdp']) && isset($_POST['mdppp'])){
	try{$base=new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
			}catch(PDOException $error){ die($error->getMessage() );}
				if($_POST['mdppp'] == ''){
				echo "<script>alert('Veuillez entrer un nouveau mot de passe avant de valider')</script>";
				}
				else{
					$sth = $base->prepare('UPDATE Utilisateur SET Mot_de_passe = ? where pseudo = ?');
					$sth->execute(array($_POST['mdppp'], $_SESSION['username']));
						echo "<script>alert('modification effectuée')</script>";
					}
}



?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title>Mon compte</title>
    <link rel="icon" type="image/png" href="ulcobet.png"/>
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
    	echo "<form action='moncompte.php' method='POST' id='formul'><button class='deco' name='deco'>Se deconnecter </button></form>";

    }
    
    
    
	if(!isset($_SESSION['username'])){   
    echo "<form action='moncompte.php' method='POST' id='formul'><input type='text' placeholder='Nom de compte' name='userid' id='userid' class='userid'/><input type='password' placeholder='Mot de passe' name='pass' id='pass' class='pass' /><button class='connex' name='connex'>Se connecter </button></form><a href='inscription.php'><button class='inscri' value='inscription.php' name='inscr'>Inscription </button></a>";
    }?>	</div>

<div class="container">
		<ul id="nav" class="myTopnav">
			<li><a></a></li>
			<li><a href="index.php">Accueil</a></li>
			<li><a href="parisencemoment.php">En ce moment</a>
			<?php 
    			if(isset($_SESSION['username'])){
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

			?>			<li class="icon"><a href="javascript:void(0);" onclick="myFunction()">&#9776;</a></li>
		</ul>
</div>
        
      <?php 
      
        try{
		$base=new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
	}
	catch(PDOException $error){ 
		die($error->getMessage() );
	}




        
        $sth = $base->prepare('select * from Utilisateur where pseudo=?');
$sth->execute(array($_SESSION['username']));
$select = $sth->fetchAll();

foreach($select as $s){
	$nom = $s['Nom'];
	$prenom= $s['Prenom'];
	$mail = $s['Adresse_email'];	
}

      
      
      
      
      
      echo "<h1>Mon compte :</h1>"; 
        echo "<div class='AL_coordonnees'>";
           echo "<h2>Mes coordonnees :</h2>";
           echo "<br>";
           echo "<h3>Nom :</h3>".$nom;
           echo "<br>";
           echo "<h3>Prenom :</h3>".$prenom;
           echo "<br>";
           echo "<h3>Adresse e-mail :</h3>".$mail;
            

            echo "<form action='moncompte.php' method='post'>";
                
            echo "<h3>Pseudo:</h3><input type='text' name='pseudo' value='".$_SESSION['username']."'/><input type='submit' value='Changer Pseudo' name='changepseudo'/><br /><br />";
            echo "<h3>Mot de passe:</h3><input type='text' name='mdppp' placeholder='Nouveau mot de passe'/><input type='submit' value='Changer Mot de passe' name='changemdp'/></form>";
              echo "<br>";
             echo "<a href='mesgages.php'><h3>Cliquer pour voir vos Gages</h3></a>";
              echo "<br>";
             echo "<a href='mesgains.php'><h3>Cliquer pour voir vos Gains</h3></a>";
             echo "</div>";  
                ?>
    </body>
</html>