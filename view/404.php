<?php $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
include $rootDir . "/view/BaseView.php";
firstBlockBody();
?>

<div class="d-flex align-items-center justify-content-center" style="height: 80vh;">
    <div class="text-center">
        <h1>
            Erreur 404
        </h1>
        <h3>
            Page Non Trouvée
        </h3>
        <p><a href="/?action=Index">Retournez à l'acceuil</a></p>
    </div>
</div>

<?php secondBlockBody();?>
