<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]) . '/gestion_cabinet/'; ?>
<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">

<?php require $rootDir."view/partial/head.php"; ?>

<body>

<?php require $rootDir."view/partial/nav.php"; ?>

<h1>
    <?= $this->msg ?>
</h1>

<?php include $rootDir."view/partial/footer.php"; ?>

</html>
