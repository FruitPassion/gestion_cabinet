<?php $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
include $rootDir . "/view/BaseView.php";
firstBlockBody();
?>

<div class="d-flex align-items-center justify-content-center" style="height: 80vh;">
    <div class="text-center">
        <h1>
            Erreur
        </h1>
        <div class="border rounded-3 pt-4 py-2 px-3 mb-3">
            <p>
                <?= $this->message ?>
            </p>
        </div>
        <small><a href="/?action=Index">Retournez à l'acceuil</a></small>
    </div>
</div>

<?php secondBlockBody(); ?>
