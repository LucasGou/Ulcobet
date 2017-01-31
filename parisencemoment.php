<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Paris dispo</title>
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
<h1>Les Ulcobets :</h1>
    <h2>UlcoBet disponibles</h2><br>
    <div class="DG_UlcoBet_disponibles">
      <p>[Description : ...]</p>
      <br>
      <p>Côte totale :</p>
      <p>Mise :</p>
      <p>Gains : <a href="roulette"> Roulette des gains</a></p>
    </div>
	<br>
	<div class="ecart">
	</div>
	 <h2>UlcoBet en cours</h2>
    <div class="DG_UlcoBet_encours">
      <p>[Description : ...]</p>
      <br>
      <p>Côte totale :</p>
      <p>Mise :</p>
      <p>Gains : <a href="roulette"> Roulette des gains</a></p>
    </div>
  </body>
</html>
