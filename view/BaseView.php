<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
function firstBlockBody() : void {
    global $rootDir;
    echo '<!DOCTYPE html>';
    echo '<html lang="fr" data-bs-theme="'.$_SESSION['theme'].'">';
    require $rootDir . "/view/partial/head.html";
    echo '<body>';
    require $rootDir . "/view/partial/nav.html";
}

function secondBlockBody() : void {
    global $rootDir;
    require $rootDir . "/view/partial/footer.html";
    echo '</body>';
    echo '</html>';
}