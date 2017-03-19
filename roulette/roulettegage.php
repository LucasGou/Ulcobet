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
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel='stylesheet' href='../style.css'>
	<link rel="stylesheet" href="css/roulete.css">
       <script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="../js/temps.js"></script>

		<script type="text/javascript" src="../js/menu.js"></script>

	<title>Ulcobet</title>
</head>
<body>
	<div id='header'>
        <a href="index.php"><img height="157" src="ulcobet.png" width="207" /></a>
		        <?php 
    if(isset($_SESSION['username'])){
    	echo "<h1 class='bonjour'>Bonjour, ".$_SESSION['username']."</h1>";
    	echo "<form action='../index.php' method='POST' id='formul'><button class='deco' name='deco'>Se deconnecter </button></form>";

    }
    
    
    
	if(!isset($_SESSION['username'])){   
    echo "<form action='../index.php' method='POST' id='formul'><input type='text' placeholder='Nom de compte' name='userid' id='userid' class='userid'/><input type='password' placeholder='Mot de passe' name='pass' id='pass' class='pass' /><button class='connex' name='connex'>Se connecter </button></form><a href='inscription.php'><button class='inscri' value='inscription.php' name='inscr'>Inscription </button></a>";
    }?>    
	</div>

<div class="container">
		<ul id="nav" class="myTopnav">
			<li><a></a></li>
			<li><a href="../index.php">Accueil</a></li>
			<?php 
    			if(isset($_SESSION['username'])){
    			echo "<li><a href='../parisencemoment.php'>En ce moment</a>";
					echo "<li><a href='../parisresultats.php'>Resultats</a>";
					echo "<li><a href='../mesparis.php'>Mes paris</a></li>";
				}
			?>					
			<li><a href="../contacts.php">Contact</a></li>
			<?php 
 			    if(isset($_SESSION['username'])){
					echo"<li><a href='../creationpari.php'>Creer un pari</a></li>";
					echo"<li><a href='../propositiongage.php'>Proposer un gage</a></li>";
					echo"<li><a href='../moncompte.php'>Mon Compte</a></li>";
				}
				if(isset($_SESSION['admin'])){
					if($_SESSION['admin']=="oui"){
						echo "<li><a href='../administration.php'>Administrer</a></li>";
					}
				}

			?>			
			<li class="icon"><a href="javascript:void(0);" onclick="myFunction()">&#9776;</a></li>
		</ul>
</div>
<h1>Roulette des gages</h1>
<div id ="LG_contenu">
	<?php
	
try{$base=new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
}catch(PDOException $error){ die($error->getMessage() );}


$sth10 = $base->prepare('select * from Utilisateur where Pseudo = ?');
$sth10->execute(array($_SESSION['username']));
$select10 = $sth10->fetchAll();

foreach($select10 as $s10){
	echo "<h3 id='Jeton'>Il vous reste ".$s10['JetonGage']." Jetons</h3>";
}




$sth = $base->prepare('select count(*) from Gage');
$sth->execute(array());
$select = $sth->fetchAll();


foreach($select as $s){
	$nbrparis = $s['count(*)'];
}

for($i = 1; $i <= 6; $i++){

	$sth2 = $base->prepare('select * from Gage where IdGage=?');
	$random = rand(1,$nbrparis);
	$sth2->execute(array($random));
	$select2 = $sth2->fetchAll();
	foreach($select2 as $s2){
		if($i==1){
			$_SESSION['rouge'] = $s2['IdGage'];
		}
		if($i==2){
			$_SESSION['orange'] = $s2['IdGage'];
		}
		if($i==3){
			$_SESSION['jaune'] = $s2['IdGage'];
		}
		if($i==4){
			$_SESSION['bleuf'] = $s2['IdGage'];
		}
		if($i==5){
			$_SESSION['bleu'] = $s2['IdGage'];
		}
		if($i==6){
			$_SESSION['bleuc'] = $s2['IdGage'];
		}
		
	}
	



}



	
	
	?>
		<div id="wrapper">
            
        <div id="wheel">
            <div id="inner-wheel">
            <?php
                if (isset($_SESSION['username'])){
                
                	$sth2 = $base->prepare('select * from Gage where IdGage=?');
					$sth2->execute(array($_SESSION['bleuc']));
					$select2 = $sth2->fetchAll();
					foreach($select2 as $s2){
					echo "<div class='sec' title='".$s2['LibelleGage']."'><span class='fa fa-bell-o' >";
					echo $s2['LibelleGage'];
											}

                 echo "</span></div>";
                
                
                	$sth2 = $base->prepare('select * from Gage where IdGage=?');
					$sth2->execute(array($_SESSION['bleu']));
					$select2 = $sth2->fetchAll();
					foreach($select2 as $s2){
					echo "<div class='sec' title='".$s2['LibelleGage']."'><span class='fa fa-comment-o'>";
					echo $s2['LibelleGage'];
											}

                 echo "</span></div>";
               
               
                	$sth2 = $base->prepare('select * from Gage where IdGage=?');
					$sth2->execute(array($_SESSION['bleuf']));
					$select2 = $sth2->fetchAll();
					foreach($select2 as $s2){
					 echo "<div class='sec' title='".$s2['LibelleGage']."'><span class='fa fa-smile-o' >";
					echo $s2['LibelleGage'];
											}

                 echo "</span></div>";
                
             
                	$sth2 = $base->prepare('select * from Gage where IdGage=?');
					$sth2->execute(array($_SESSION['jaune']));
					$select2 = $sth2->fetchAll();
					foreach($select2 as $s2){
					echo "<div class='sec' title='".$s2['LibelleGage']."'><span class='fa fa-heart-o' >";
					echo $s2['LibelleGage'];
											}

                 echo "</span></div>";
                
                
                	$sth2 = $base->prepare('select * from Gage where IdGage=?');
					$sth2->execute(array($_SESSION['orange']));
					$select2 = $sth2->fetchAll();
					foreach($select2 as $s2){
					echo "<div class='sec' title='".$s2['LibelleGage']."'><span class='fa fa-star-o'>";
					echo $s2['LibelleGage'];
											}

                 echo "</span></div>";
                
            
                	$sth2 = $base->prepare('select * from Gage where IdGage=?');
					$sth2->execute(array($_SESSION['rouge']));
					$select2 = $sth2->fetchAll();
					
					foreach($select2 as $s2){
					echo "<div class='sec' title='".$s2['LibelleGage']."'><span class='fa fa-lightbulb-o' >";
					echo $s2['LibelleGage'];
											}

                echo "</span></div>";}?>
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
<script src="js/index2.js"></script>

               
</body>
</html>