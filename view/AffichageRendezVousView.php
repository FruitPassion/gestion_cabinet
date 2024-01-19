<?php $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
include $rootDir . "/view/BaseView.php";
firstBlockBody();
?>
    <?php foreach ($this->getErreurs() as $erreur): ?>
        <div class="text-center">
            <p class="text-bg-danger fs-5"><?= $erreur ?></p>
        </div>
    <?php endforeach; ?>
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
            <h3 class="text-center mt-4">Chercher un element :</h3>
            <div class="input-group w-75 m-auto my-4">
                <input type="search" oninput="chercher_element_tableau(this)" class="form-control rounded"
                       placeholder="Patient, Medecin, Heure ..." aria-label="Search" aria-describedby="search-addon"/>
            </div>
            <h4 class="text-center mt-4" id="aucun_element" style="display: none">Aucun RDV ne correspond à votre
                recherche</h4>
            <div class="d-flex flex-wrap justify-content-center p-3 w-75 m-auto">
                <table class="table table-bordered mt-3">
                    <thead class="table-secondary">
                    <tr class="text-center">
                        <th scope="col">Medecin</th>
                        <th scope="col">Patient</th>
                        <th scope="col">Date</th>
                        <th scope="col">Heure</th>
                        <th scope="col">Durée</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody id="body-table" >
                    <?php foreach ($this->planning->getRendezVous() as $rdv): ?>
                        <tr>
                            <td class="align-middle"><?= $rdv->getMedecin()->getEtatCivil()->getNomPrenom() ?></td>
                            <td class="align-middle"><?= $rdv->getPatient()->getEtatCivil()->getNomPrenom() ?></td>
                            <td class="text-center align-middle">
                                <?php $date=date_create($rdv->getDate());
                                echo date_format($date,"d/m/Y");?></td>
                            <td class="text-center align-middle"><?= $rdv->getHeure() ?></td>
                            <td class="text-center align-middle" ><?= $rdv->getDuree() ?> minutes</td>
                            <th scope="row">
                                <form method="post"  action="/VisualisationRendezVous">
                                    <input type="hidden" name="id_patient" value="<?= $rdv->getPatient()->getId() ?>">
                                    <input type="hidden" name="id_medecin" value="<?= $rdv->getMedecin()->getId() ?>">
                                    <input type="hidden" name="date_rdv" value="<?= $rdv->getDate() ?>">
                                    <a><button type="submit" class="btn btn-primary form-control">Voir le rdv</button></a>
                                </form>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div style="height: 100px"></div>
        </div>
        <div class="tab-pane fade" id="ajouter" role="tabpanel" aria-labelledby="ajouter-tab">
            <h3 class="text-center mt-4">Ajouter un Rendez-Vous :</h3>
            <form class="w-75 mx-auto my-4" method="post" action="/GererRendezVous">
                <input type="hidden" name="action" id="action" value="ajouter">
                <div class="d-flex w-100">
                    <div class="mb-3 px-3 w-50">
                        <label for="patientInput" class="form-label">Patient :</label>
                        <select class="form-select" name="patientInput" id="patientInput"
                                aria-label="selectionner medecin">
                            <?php foreach ($this->planning->getPatients() as $patient): ?>
                                <option value="<?= $patient->getId() ?>"><?= $patient->getEtatCivil()->getNomPrenom() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3 px-3 w-50">
                        <label for="medecinInput" class="form-label">Medecin :</label>
                        <select class="form-select" name="medecinInput" id="medecinInput"
                                aria-label="selectionner medecin">
                            <?php foreach ($this->planning->getMedecins() as $medecin): ?>
                                <option value="<?= $medecin->getId() ?>"><?= $medecin->getEtatCivil()->getNomPrenom() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="d-flex w-100">
                    <div class="mb-3 px-3" style="width: 33%">
                        <label for="dateInput" class="form-label">Date du rendez-vous :</label>
                        <input required type="date" class="form-control a-verifier"
                               name="dateInput" id="dateInput" aria-describedby="nss"
                               oninput="activerModification()">
                    </div>
                    <div class="mb-3 px-3" style="width: 33%">
                        <label for="heureInput" class="form-label">Heure de consultation :</label>
                        <select class="form-select" name="heureInput" id="heureInput"
                                aria-label="selectionner medecin">
                            <!-- Genere une liste d'heure de consultation de 9h à 18h -->
                            <?php $heure = 9;
                            $minute = 0;
                            $heureFin = 17;
                            $minuteFin = 30;
                            while ($heure < $heureFin || ($heure == $heureFin && $minute < $minuteFin)): ?>
                                <option value="<?= sprintf("%02d", $heure) . ":" . sprintf("%02d", $minute) . ":00" ?>">
                                    <?= sprintf("%02d", $heure) . ":" . sprintf("%02d", $minute); ?></option>
                                <?php $minute += 30;
                                if ($minute == 60) {
                                    $heure++;
                                    $minute = 0;
                                }
                            endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3 px-3" style="width: 34%">
                        <label for="dureeInput" class="form-label">Durée de consultation :</label>
                        <select class="form-select" name="dureeInput" id="dureeInput"
                                aria-label="selectionner medecin">
                            <option value="15">15 minutes</option>
                            <option value="30" selected>30 minutes</option>
                            <option value="45">45 minutes</option>
                            <option value="60">1 heure</option>
                        </select>
                    </div>
                </div>
                <button disabled id="btn-validation" type="submit" class="btn btn-primary form-control my-3">Envoyer</button>
            </form>
        </div>
    </div>

    <script src="/static/js/chercher-element-tableau.js"></script>
    <script src="/static/js/verifier-elements-valides.js"></script>

<?php secondBlockBody(); ?>