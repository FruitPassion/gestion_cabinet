<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
function firstBlockBody() : void {
    global $rootDir;
    echo '<!DOCTYPE html>';
    echo '<html lang="fr" data-bs-theme="'.$_SESSION['theme'].'">';
    require $rootDir . "/view/partial/head.html";
    echo '<body>';
}

function secondBlockBody() : void {
    echo '</body>';
    echo '</html>';
}