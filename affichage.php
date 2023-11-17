<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">

<?php include 'partial/head.php'; ?>

<body>

<?php include 'partial/nav.php'; ?>

<?php
$abs = $_SERVER['DOCUMENT_ROOT'];
include_once($abs."/gestion_cabinet/controller/EtatCivil.class.php");
include_once($abs."/gestion_cabinet/controller/Medecin.class.php");
include_once($abs."/gestion_cabinet/controller/Patient.class.php");

$medeta = new EtatCivil(true, "doctor", "who");
$med = new Medecin($medeta, "tardis", "tardis", "tardis", "tarpin longtemps", "unknown", -1);
$eta = new EtatCivil(true, "hamood", "de bourpalette");
$usr = new Patient($eta, "25 rue du toz", "69690", "hamood land", "1 janvier 1969", "a l'hopital", 6969696969);
$usr->definirReferant($med);

function afficherMed(){
  echo "affichage du medecin : ".$_POST["nom_med"]."<br>";
}

function afficherPat($u){
  if ($_POST['nom_user'] != $u->getEtatCivil()->getNom()){
    echo 'utilisateur inexistant<br><a href="/">retour au menu</a>';
    return;
  }

  echo "affichage de l'utilisateur : ".$_POST["nom_user"]."<br>";

  //$medref = $u->getMedecinReferrant->getEtatCivil->getNom();
  $medref = "hatoz";

  echo '<form action="affichage.php" method="post">';
  echo '<p>Afficher son medecin :</p>';
  echo '<input type="text" readonly name="nom_med" value="'.$medref.'">';
  echo '<input type="submit" value="afficher">';
  echo '</form>';
}

if (isset($_POST['nom_user'])){
  afficherPat($usr);
} else if (isset($_POST['nom_med'])){
  afficherMed();
}else{
  header("location: index.php");
  exit(1);
}

include_once("./partial/footer.php")
?>

<?php include 'partial/footer.php'; ?>

</html>
