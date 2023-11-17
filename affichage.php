<?php

$abs = $_SERVER['DOCUMENT_ROOT'];
include_once($abs."/gestion_cabinet/oop_data/EtatCivil.class.php");
include_once($abs."/gestion_cabinet/oop_data/Medecin.class.php");
include_once($abs."/gestion_cabinet/oop_data/Patient.class.php");

$medeta = new EtatCivil(true, "doctor", "who");
$med = new Medecin($medeta, "tardis", "tardis", "tardis", "tarpin longtemps", "unknown", -1);
$eta = new EtatCivil(true, "hamood", "de bourpalette");
$usr = new Patient($eta, "25 rue du toz", "69690", "hamood land", "1 janvier 1969", "a l'hopital", 6969696969);
$usr->definirReferant($med);

function afficherMed(){
  echo "affichage du medecin : ".$_POST["nom_med"]."<br>";
}

function afficherPat(){
  echo "affichage de l'utilisateur : ".$_POST["nom_user"]."<br>";

  $medref = $usr->getMedecinReferrant->getEtatCivil->getNom();

  echo '<form action="affichage.php" method="post">';
  echo '<input type="submit" value="afficher son medecin" name="'.$medref.'">';
  echo '</form>';
}

if (isset($_POST['nom_user'])){
  afficherPat();
} else if (isset($_POST['nom_med'])){
  afficherMed();
}else{
  header("location: index.php");
  exit(1);
}

?>
