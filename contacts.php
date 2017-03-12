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
	<title>Contacts</title>
    <link rel="icon" type="image/png" href="Images/ulcobet.png"/>
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
    	echo "<form action='contacts.php' method='POST' class='formul'><button class='deco' name='deco'>Se deconnecter </button></form>";
    }
    
    
    
	if(!isset($_SESSION['username'])){   
    echo "<form action='contacts.php' method='POST' class='formul'><input type='text' placeholder='Nom de compte' name='userid' id='userid' class='userid'/><input type='password' placeholder='Mot de passe' name='pass' id='pass' class='pass' /><button class='connex' name='connex'>Se connecter </button></form><a href='inscription.php'><button class='inscri' value='inscription.php' name='inscr'>Inscription </button></a>";
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
		</ul>
</div>
    
        <div id="ALContenu">
        <h1>Formulaire de contact :</h1>
        <div class="AL_contacts">
		
            <p>Un bug ? Un probleme ? Une demande de partenariat ?<br>
            <strong>Envoyez votre message, notre equipe tachera de vous repondre le plus rapidement possible !</strong></p>
            <br>
            
                <?php 
        
        
        require_once "tag.lib.php";
require_once "check.lib.php";
try{$base=new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
}catch(PDOException $error){ die($error->getMessage() );}
            $body="<form method='POST' action=contacts.php>\n";
$body.="<label for='nd'><h5>Nom d'utilisateur</h5></label>";  
$body.="<input type text='text' name='nd' placeholder='Nom utilisateur'>";
                
$body.="<label for='Adresse_email'><h5>Adresse_email</h5></label>";
$body.="<input type text='text' name='Adresse_email' placeholder='email@univ-littoral.fr'>";
$body.="</br>";
$body.="<label for='Message'><h5>Message</h5></label>";
$body.="<textarea text='text' id='Message' name='Message' placeholder='Ecrivez votre message' rows='10' cols='70'></textarea>"; 
$body.="</br>";                
      $body.="</br>";           
$body.="<input type='submit' name='envoif' value='Envoyer'>";
$body.="</br>";
$body.="</form>";
        
        $req="SELECT * FROM Contact";
         
         $css="style.css";
        
if((isset($_POST['Adresse_email'])!=NULL)&&($_POST['nd']!=NULL)&&($_POST['Message']!=NULL)){
$sqll="INSERT INTO Contact(nd,Adresse_email,Message) VALUES(lower('{$_POST['nd']}'),lower('{$_POST['Adresse_email']}'),lower('{$_POST['Message']}'));";
if(!$affected_rows=$base->exec($sqll)) die(" Erreur : $sqll "); 
}
 
        
if(!$result=$base->query($req, PDO::FETCH_ASSOC)) die("Probleme $req");
            
            
             if((isset($_POST['nd'])!=NULL)&&($_POST['Adresse_email']!=NULL)&&($_POST['Message']!=NULL)){
      
        echo "<script>alert(\"Message envoyé\")</script>";  
                 
             }
            
            if(((isset($_POST['nd'])==NULL)||($_POST['Adresse_email']==NULL)||($_POST['Message']==NULL)) && isset($_POST['evoif'])){
      
        echo "<script>alert(\"Il manque un element dans le formulaire pour l envoi du message\")</script>";  
                 
             }
            
            
     require_once "template.php";
?>
        
                
    
            
            
        </div>
        </div>
    </body>
</html>