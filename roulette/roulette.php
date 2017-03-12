<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel='stylesheet' href='style.css'>
	<link rel="stylesheet" href="css/roulete.css"> 
		<script type="text/javascript" src="js/menu.js"></script>

	<title>Ulcobet</title>
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
<h1>Roulette</h1>
<div id ="LG_contenu">
	
		<div id="wrapper">
            
        <div id="wheel">
            <div id="inner-wheel">
                <div class="sec"><span class="fa fa-bell-o"></span></div>
                <div class="sec"><span class="fa fa-comment-o"></span></div>
                <div class="sec"><span class="fa fa-smile-o"></span></div>
                <div class="sec"><span class="fa fa-heart-o"></span></div>
                <div class="sec"><span class="fa fa-star-o"></span></div>
                <div class="sec"><span class="fa fa-lightbulb-o"></span></div>
            </div>       
           
            <div id="spin">
                <div id="inner-spin"></div>
            </div>
            
            <div id="shine"></div>
        </div>
        
        
        <div id="txt"></div>
  </div>
</div>
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>

               
</body>
</html>