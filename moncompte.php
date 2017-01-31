<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title>Mon compte</title>
    <link rel="icon" type="image/png" href="ulcobet.png"/>
    <link rel="stylesheet" href="style.css">
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
        
       <h1>Mon compte :</h1> 
        <div class="AL_coordonnees">
            <h2>Mes coordonnées :</h2>
            <br>
                <h3>Nom :</h3>
                <h3>Prenom :</h3>
                <h3>Adresse :</h3>
                <h3>Ecole :</h3>
                <h3>Departement :</h3>
                <h3>Numereo de telephone :</h3>
                <h3>Adresse e-mail :</h3>
                
        </div>
        <div class="AL_gainsgages">
            <h3>Mes gains :</h3>
            <h3>Mes gages :</h3>
            <br>
            <a href="" >Paramètres de confidentialité</a>
        </div>
    </body>
</html>