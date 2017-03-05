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
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel='stylesheet' href='style.css'>
	
	<script type="text/javascript" src="js/menu.js"></script>
	
	<title>Ulcobet</title>
</head>
<body>
	<div id='header'>
        <a href="index.php"><img height="157" src="ulcobet.png" width="207" /></a>
        
        <?php 
    if(isset($_SESSION['username'])){
    	echo "<h1 class='bonjour'>Bonjour, ".$_SESSION['username']."</h1>";
    	echo "<form action='index.php' method='POST' class='formul'><button class='deco' name='deco'>Se deconnecter </button></form>";

    }
    
    
    
	if(!isset($_SESSION['username'])){   
    echo "<form action='index.php' method='POST' class='formul'><input type='text' placeholder='Nom de compte' name='userid' id='userid' class='userid'/><input type='password' placeholder='Mot de passe' name='pass' id='pass' class='pass' /><button class='connex' name='connex'>Se connecter </button></form><a href='inscription.php'><button class='inscri' value='inscription.php' name='inscr'>Inscription </button></a>";
    }?>    
	</div>

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
<h1>Actualites</h1>
    <div id ="DL_contenu">
	<div id="Actus1">
	 <img height="157" src="img/image1.jpg" width="207" /><a class=texte1>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nec nulla ac eros vehicula posuere. In aliquet ante sit amet mi venenatis blandit. Phasellus ac imperdiet mauris, vitae condimentum purus.</a><br>
    </div>
    <div id="Actus2">    
	 <img height="157" src="img/image2.jpg" width="207" /><a class=texte1>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nec nulla ac eros vehicula posuere. In aliquet ante sit amet mi venenatis blandit. Phasellus ac imperdiet mauris, vitae condimentum purus.</a><br>
	</div>
     <div id="Actus3">    
	 <img height="157" src="img/image3.jpg" width="207" /><a class=texte1>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nec nulla ac eros vehicula posuere. In aliquet ante sit amet mi venenatis blandit. Phasellus ac imperdiet mauris, vitae condimentum purus.</a><br>
	</div>
    <div id="Actus4">    
	 <img height="157" src="img/image4.jpg" width="207" /><a class=texte1>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nec nulla ac eros vehicula posuere. In aliquet ante sit amet mi venenatis blandit. Phasellus ac imperdiet mauris, vitae condimentum purus.</a><br>
	</div>
 </div> 

               
</body>
</html>