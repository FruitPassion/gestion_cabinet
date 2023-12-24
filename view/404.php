<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]) . '/gestion_cabinet/'; ?>
<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">

<?php require $rootDir . "view/partial/head.php"; ?>

<body>

<?php require $rootDir . "view/partial/nav.php"; ?>

<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center">
        <h1>
            Erreur 404
        </h1>
        <h3>
            Page Non Trouvée
        </h3>
        <p><a href="/gestion_cabinet/?action=Index">Retournez à l'acceuil</a></p>
    </div>
</div>

<?php include $rootDir . "view/partial/footer.php"; ?>

</html>
