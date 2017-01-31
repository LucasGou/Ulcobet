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
		        <input type="text" placeholder="Nom de compte" name="userid" id="userid" class="userid"/>
        <input type="password" placeholder="Mot de passe" name="pass" id="pass" class="pass" /> 
        <button class="connex" >Se connecter </button>
        <button class="inscri" value="inscription.php">Inscription </button>
	</div>

	<div class="container">
		<ul id="nav" class="myTopnav">
			<li><a></a></li>
			<li><a href="index.php">Accueil</a></li>
			<li><a href="parisencemoment.php">En ce moment</a>
			<li><a href="parisresultats.php">Résultats</a>
			<li><a href="mesparis.php">Mes paris</a></li>
			<li><a href="contacts.php">Contact</a></li>
			<li><a href="creationpari.php">Créer un pari</a></li>
			<li><a href="propositiongage.php">Proposer un gage</a></li>
			<li class="icon"><a href="javascript:void(0);" onclick="myFunction()">&#9776;</a></li>
		</ul>
</div>
		<h1>Creation de  pari</h1>
		  <div class ="LG_formucreapari">
		  <form class="Formu" novalidate>
			    <label for="Titrepari"><h5>Titre du pari</h5></label>
                <input  id="Titrepari" type="text" placeholder="Titre pari" id="LG_Titre" /></br></br>
    
			    <label for="Description du pari"><h5>Description du pari</h5></label>
			    <textarea text = "Description du pari" id="Description du pari" placeholder="Ecrivez une description comléte et précise de votre pari (mise en jeu, adversaire, categorie, ...)" rows="10" cols="70"></textarea> </br></br>
	       		
			    <label for="datedebut"><h5>Date de début et de fin du pari:</h5></label>
			    <input type="date" id="Datedebut" name="datedebut" placeholder="Date de début" id="LG_ddb" />
			    <input type="date" id="Dateecheance" name="dateecheance" placeholder="Date de fin" id="LG_ddf" /></br></br>

                <label for="Choix du gage pour le perdant"><h5>Choix du gage pour le perdant</h5></label>
                <input type="submit" id="Choix du gage pour le perdant" value = "Choix dans la liste aleatoire"/>
                <a href="roulette/roulette.html"><input type="submit" value = "Tourner la roulette des gages" /></a></br></br></br>

                <div class ="LG_button">
			    <input  type="submit" value = "Proposer aux admins" /></br>
                </div>
				</form>
                

	    </div>
	</div>
</body>
</html>