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
                    <form class="Formu" novalidate>
                        <div class="formulaire">
            <label for="civilité"><h5>Civilite *</h5></label>
            <select name="civilité">
                <option value="Monsieur">Monsieur</option>
                <option value="Madame">Madame</option>
                <option value="Autres">Autres</option></select>
            <br />
            <label for="nom"><h5>Nom *</h5></label>
                <input type="text" placeholder="nom" id="nom" required/>
                <input type="text" placeholder="prenom" id="prenom" required/>
            <br />
               <div class="email">
                <label for="email"><h5>Email *</h5></label>
                <input type="email" placeholder="nom@mel-etu...ou univ-litt..." required/>
                <br />
                    <div class="password">
                <label for="password"><h5>Mot de passe *</h5></label>
                <input type="password" placeholder="mdp" required/>
                 <br />
                    <div class="dateanniv">
                <label for="dateanniv"><h5>Date anniversaire</h5></label>
                <input type="date" placeholder="ex:12/05/98" />
                <br />
                    <div class="numtel">
                <label for="numtel"><h5>Num tel</h5></label>
                <input type="text" placeholder="060516515" />
                 <br /> 
                     <br />    
                <div class="button">
                    <input type="submit" value="Envoyer"/><br>
                </div>
                           
                           <p> * champs obligatoires</p>
            </div>
                </div>            
        </div>
             </div>
             
                            
                            </div>
        </form>
		      
        
        </div>
         </div>
        



</body>
 
</html>

			