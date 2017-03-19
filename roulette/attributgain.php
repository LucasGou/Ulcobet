<?php
session_start();

if($_POST['param1'] == "rouge"){
$param2 = $_SESSION['rouge'];
}

if($_POST['param1'] == "orange"){
$param2 = $_SESSION['orange'];
}

if($_POST['param1'] == "jaune"){
$param2 = $_SESSION['jaune'];
}

if($_POST['param1'] == "bleuf"){
$param2 = $_SESSION['bleuf'];
}

if($_POST['param1'] == "bleu"){
$param2 = $_SESSION['bleu'];
}

if($_POST['param1'] == "bleuc"){
$param2 = $_SESSION['bleuc'];
}

var_dump($_POST['param1']);

$bdd = new PDO('mysql:host=mysql-ulcobet.alwaysdata.net;dbname=ulcobet_db','ulcobet','TP3foreveR');
$sth2 = $bdd->prepare("select * from Utilisateur where Pseudo = ?");
$sth2->execute(array($_SESSION['username']));
$select2 = $sth2->fetchAll();

foreach($select2 as $s2){

if ($s2['JetonGain'] > 0){
$sth = $bdd->prepare("insert into Attribuer_gain(User, IdGain) values(?,?)");
$sth->execute(array($_SESSION['username'], $param2));
$sth4 = $bdd->prepare('UPDATE Utilisateur SET JetonGain = JetonGain-1 where Pseudo = ?');
$sth4->execute(array($_SESSION['username']));

}}
?>