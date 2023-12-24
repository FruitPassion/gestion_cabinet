<?php $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]) . "/gestion_cabinet/";
include $rootDir."view/BaseView.php";
firstBlockBody();
?>

<ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="medecins-tab" data-bs-toggle="tab" data-bs-target="#medecins" type="button"
                role="tab" aria-controls="affichage" aria-selected="true">Patients
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="ajouter-tab" data-bs-toggle="tab" data-bs-target="#ajouter" type="button"
                role="tab" aria-controls="ajout" aria-selected="false">Ajouter
        </button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="medecins" role="tabpanel" aria-labelledby="medecins-tab">

    </div>
    <div class="tab-pane fade" id="ajouter" role="tabpanel" aria-labelledby="ajouter-tab">...</div>
</div>

<?php secondBlockBody();?>