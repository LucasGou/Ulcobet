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
	<title>Mes paris</title>
    <link rel="icon" type="image/png" href="ulcobet.png"/>
    <link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="js/menu.js"></script>

</head>
<body>
	<div id='header'>
        <a href="index.php"><img height="157" src="ulcobet.png" width="207" /></a>
		        <?php 
    if(isset($_SESSION['username'])){
    	echo "<h1 class='bonjour'>Bonjour, ".$_SESSION['username']."</h1>";
    	echo "<form action='mesparis.php' method='POST' class='formul'><button class='deco' name='deco'>Se deconnecter </button></form>";

    }
    
    
    
	if(!isset($_SESSION['username'])){   
    echo "<form action='mesparis.php' method='POST' class='formul'><input type='text' placeholder='Nom de compte' name='userid' id='userid' class='userid'/><input type='password' placeholder='Mot de passe' name='pass' id='pass' class='pass' /><button class='connex' name='connex'>Se connecter </button></form><a href='inscription.php'><button class='inscri' value='inscription.php' name='inscr'>Inscription </button></a>";
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
        
        <h1>Mes paris :</h1>
        <br>
		<h2>Paris gagnés</h2>
        <div class="AL_ParisGagnes">
                <p>[Description...]</p>
            <br>
            <p>Cote Totale : Mise : Gains : <a href="roulette">Roulette des gains</a></p>
        </div>
        
        <br>
             <h2>Paris perdus</h2>
        <div class="AL_ParisPerdus">
                <p>[Description...]</p>
            <br>
            <p>Cote Totale : Mise : Gages : <a href="roulette">Roulette des gages</a></p>
        </div>
    </body>
</html>