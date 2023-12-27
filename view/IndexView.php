<?php $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
include $rootDir."/view/BaseView.php";
firstBlockBody($afficher = true);
?>

<!-- Index page -->
<div class="d-flex align-items-center justify-content-center" style="height: 80vh;">
    <div class="text-center">
        <h1>
            Bienvenue sur la gestion de cabinet <img style="height: 30px;" src="/static/images/logo.png" alt="logo">
        </h1>
        <div class="border rounded-3 pt-4 py-2 px-3 mb-3">
            <p>
                Ce site vous permet de gérer les patients de votre cabinet médical.<br>
                Il est réalisé dans le cadre d'un projet de BUT Informatique à l'IUT de Toulouse.
            </p>
        </div>
        <a href="/AffichageMedecins"><button class="btn btn-secondary">Voir les médecins</button></a>
        <a href="/AffichagePatients"><button class="btn btn-secondary">Voir les patients</button></a>
        <a href="#"><button class="btn btn-secondary">Voir le planning</button></a>
        <a href="/Statistiques"><button class="btn btn-secondary">Voir les statistiques</button></a>
    </div>

<?php secondBlockBody();?>
