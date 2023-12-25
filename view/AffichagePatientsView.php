<?php $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
include $rootDir . "/view/BaseView.php";
firstBlockBody();
?>
    <ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="patients-tab" data-bs-toggle="tab" data-bs-target="#patients"
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
        <div class="tab-pane fade show active" id="patients" role="tabpanel" aria-labelledby="patients-tab">
            <h3 class="text-center mt-4">Chercher un patient :</h3>
            <div class="input-group w-75 m-auto my-4">
                <input type="search" oninput="chercher_element(this)" class="form-control rounded"
                       placeholder="Philippe Durand ..." aria-label="Search" aria-describedby="search-addon"/>
            </div>
            <h4 class="text-center mt-4" id="aucun_element" style="display: none">Aucun patient ne correspond à votre
                recherche</h4>
            <div class="d-flex flex-wrap justify-content-center p-3">
                <?php foreach ($this->patients as $patient): ?>
                    <div class="card m-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $patient->getEtatCivil()->getNomPrenom() ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $patient->getEtatCivil()->getCivilite(); ?></h6>
                            <p class="card-text"><?= $patient->getAddresseComplete() ?></p>
                            <form method="post"  action="/?action=VisualisationPatient">
                                <input type="hidden" name="id_patient" value="<?= $patient->getId() ?>">
                                <button type="submit" class="btn btn-primary">Voir les détails</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="tab-pane fade" id="ajouter" role="tabpanel" aria-labelledby="ajouter-tab">
            <h3 class="text-center mt-4">Ajouter un patient :</h3>
            <form class="w-75 mx-auto my-4" method="post" action="/controller/GererPatientController.class.php">
                <input type="hidden" name="action" id="action" value="ajouter">
                <div class="d-flex w-100">
                    <div class="mb-3 px-3 w-50">
                        <label for="nomInput" class="form-label">Nom :</label>
                        <input required type="text" class="form-control" name="nomInput" id="nomInput"
                               aria-describedby="nom">
                    </div>
                    <div class="mb-3 px-3 w-50">
                        <label for="prenomInput" class="form-label">Prenom :</label>
                        <input required type="text" class="form-control" name="prenomInput" id="prenomInput"
                               aria-describedby="prenom">
                    </div>
                </div>
                <div class="d-flex w-100">
                    <div class="mb-3 px-3 w-50">
                        <label for="civiliteInput" class="form-label">Civilite :</label>
                        <select class="form-select" id="civiliteInput" name="civiliteInput"
                                aria-label="selectionner civilite">
                            <option selected value="0">Monsieur</option>
                            <option value="1">Madame</option>
                        </select>
                    </div>
                    <div class="mb-3 px-3 w-50">
                        <label for="adresseInput" class="form-label">Adresse :</label>
                        <input required type="text" class="form-control" name="adresseInput" id="adresseInput"
                               aria-describedby="adresse">
                    </div>
                </div>
                <div class="d-flex w-100">
                    <div class="mb-3 px-3 w-50">
                        <label for="codePostalInput" class="form-label">Code Postal :</label>
                        <input required type="number" max="999999" min="11111" maxlength="5" minlength="5"
                               class="form-control"
                               name="codePostalInput" id="codePostalInput" aria-describedby="codePostal">
                    </div>
                    <div class="mb-3 px-3 w-50">
                        <label for="villeInput" class="form-label">Ville :</label>
                        <input required type="text" class="form-control" name="villeInput" id="villeInput"
                               aria-describedby="ville">
                    </div>
                </div>
                <div class="d-flex w-100">
                    <div class="mb-3 px-3 w-50">
                        <label for="ddnInput" class="form-label">Date de naissance :</label>
                        <input required type="date" class="form-control" name="ddnInput" id="ddnInput"
                               aria-describedby="ddn">
                    </div>
                    <div class="mb-3 px-3 w-50">
                        <label for="lieuNaissanceInput" class="form-label">Lieu de naissance :</label>
                        <input required type="text" class="form-control" name="lieuNaissanceInput"
                               id="lieuNaissanceInput"
                               aria-describedby="lieuNaissance">
                    </div>
                </div>
                <div class="d-flex w-100">
                    <div class="mb-3 px-3 w-50">
                        <label for="nssInput" class="form-label">Numéro de sécurité sociale :</label>
                        <input required type="number" min="0" maxlength="15" minlength="15" class="form-control"
                               name="nssInput" id="nssInput" aria-describedby="nss">
                    </div>
                    <div class="mb-3 px-3 w-50">
                        <label for="medecinInput" class="form-label">Medecin referrant:</label>
                        <select class="form-select" name="medecinInput" id="medecinInput"
                                aria-label="selectionner medecin">
                            <option selected value="null">Aucun</option>
                            <?php foreach ($this->medecins as $medecin): ?>
                                <option value="<?= $medecin->getId() ?>"><?= $medecin->getEtatCivil()->getNomPrenom() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary form-control my-3">Envoyer</button>
            </form>
        </div>
    </div>

    <script src="/static/js/chercher-element.js" defer></script>

<?php secondBlockBody(); ?>