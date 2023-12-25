<?php $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]) . "/gestion_cabinet/";
include $rootDir . "view/BaseView.php";
firstBlockBody();
?>

    <ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="medecins-tab" data-bs-toggle="tab" data-bs-target="#medecins"
                    type="button"
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
            <h3 class="text-center mt-4">Chercher un medecin :</h3>
            <div class="input-group w-75 m-auto my-4">
                <input type="search" oninput="chercher_element(this)" class="form-control rounded"
                       placeholder="Philippe Durand ..." aria-label="Search" aria-describedby="search-addon"/>
            </div>
            <div class="d-flex flex-wrap justify-content-center p-3">
                <?php foreach ($this->medecins as $medecin): ?>
                    <div class="card m-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $medecin->getEtatCivil()->getNomPrenom() ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $medecin->getEtatCivil()->getCivilite(); ?></h6>
                            <a href="#" class="card-link bottom-0">Voir les détails</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="tab-pane fade" id="ajouter" role="tabpanel" aria-labelledby="ajouter-tab">
            <h3 class="text-center mt-4">Ajouter un medecin :</h3>
            <form class="w-75 mx-auto my-4">
                <div class="d-flex w-100">
                    <div class="mb-3 px-3 w-50">
                        <label for="nomInput" class="form-label">Nom :</label>
                        <input required type="text" class="form-control" id="nomInput" aria-describedby="nom">
                    </div>
                    <div class="mb-3 px-3 w-50">
                        <label for="prenomInput" class="form-label">Prenom :</label>
                        <input required type="text" class="form-control" id="prenomInput" aria-describedby="prenom">
                    </div>
                </div>
                <div class="mb-3 px-3">
                    <label for="civiliteInput" class="form-label">Civilite :</label>
                    <select class="form-select" id="civiliteInput" aria-label="selectionner civilite">
                        <option selected value="0">Monsieur</option>
                        <option value="1">Madame</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary form-control my-3">Envoyer</button>
            </form>
        </div>
    </div>

    <script src="/gestion_cabinet/static/js/chercher-element.js" defer></script>

<?php secondBlockBody(); ?>