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
        <div id="ALContenu">
        <h1>Formulaire de contact :</h1>
        <div class="AL_contacts">
		<form class="Formu" novalidate>
            <p>Un bug ? Un problÃ¨me ? Une demande de partenariat ?<br>
            <strong>Envoyez votre message, notre Ã©quipe tÃ¢chera de vous rÃ©pondre le plus rapidement possible !</strong></p>
            <br>
            <div class="AL_formulaire">
                <label for="nd"><h5>Nom d'utilisateur :</h5></label>
                <input id="nd" required />
                <br>
                <label for="am"><h5>Adresse e-mail :</h5></label>
                <input id="am" required />
                <br>
                <label for="message"><h5>Message :</h5></label>
                <input id="message" class="AL_message" required />
                <br>
                <div class="button">
					<input type="submit" value="Envoyer"/><br>
				</div>
        </div>
        </div>
        
    </body>
</html>
