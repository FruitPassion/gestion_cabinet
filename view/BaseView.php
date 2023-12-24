<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]) . '/gestion_cabinet/';
function firstBlockBody(){
    global $rootDir;
    echo '<!DOCTYPE html>';
    echo '<html lang="fr" data-bs-theme="'.$_SESSION['theme'].'">';
    require $rootDir."view/partial/head.php";
    echo '<body>';
    require $rootDir."view/partial/nav.php";
}

function secondBlockBody(){
    global $rootDir;
    require $rootDir."view/partial/footer.php";
    echo '</body>';
    echo '</html>';
}