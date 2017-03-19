<?php
session_start();
$bdd = new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
//$sth = $bdd->prepare('SELECT * FROM ? WHERE TIMEDIFF(#DateEcheance, curdate()) < 0');
$sth = $bdd->prepare('SELECT * FROM Pari WHERE `#DateEcheance` <= CURDATE() AND Statut = 0 ');
$sth->execute(array());
$select = $sth->fetchAll();
var_dump($select);
var_dump($sth);
foreach($select as $s){
$sth2 = $bdd->prepare('UPDATE Pari SET Statut = 1 where IdPari = ?');
$sth2->execute(array($s['IdPari']));


$sth10 = $bdd->prepare('SELECT * FROM Utilisateur');
$sth10->execute(array());
$select10 = $sth10->fetchAll();

foreach($select10 as $s10){



$sth3 = $bdd->prepare('SELECT * FROM Participer_pari WHERE IdPari = ? and PseudoUser = ?');
$sth3->execute(array($s['IdPari'],$s10['Pseudo']));
$select3 = $sth3->fetchAll();

foreach($select3 as $s3){

	if($s3['choix'] == 1){
		if($s['choix1'] == $s['Resultat']){
			$sth4 = $bdd->prepare('UPDATE Utilisateur SET JetonGain = JetonGain+1 where Pseudo = ?');
			$sth4->execute(array($s10['Pseudo']));
		}
		if($s['choix1'] != $s['Resultat']){
			$sth4 = $bdd->prepare('UPDATE Utilisateur SET JetonGage = JetonGage+1 where Pseudo = ?');
			$sth4->execute(array($s10['Pseudo']));
		}

	}
	if($s3['choix'] == 2){
		if($s['choix2'] == $s['Resultat']){
			$sth4 = $bdd->prepare('UPDATE Utilisateur SET JetonGain = JetonGain+1 where Pseudo = ?');
			$sth4->execute(array($s10['Pseudo']));
		}
		if($s['choix2'] != $s['Resultat']){
			$sth4 = $bdd->prepare('UPDATE Utilisateur SET JetonGage = JetonGage+1 where Pseudo = ?');
			$sth4->execute(array($s10['Pseudo']));
		}

	}

	var_dump($select3);


}
}

}








?>