<?php $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
include $rootDir . "/view/BaseView.php";
firstBlockBody();
?>

<div class="d-flex align-items-center justify-content-center" style="height: 80vh">
    <div class="w-75 mx-auto my-4">
        <h3 class="text-center mt-4">Informations du patient :</h3>
        <form method="post" action="/GererPatient" name="formModifier" id="formModifier"
              class="border rounded-4 py-4">
            <input type="hidden" name="id_patient" id="id_patient" value="<?= $this->patient->getId(); ?>">
            <input type="hidden" name="action" id="action" value="modifier">
            <div class="mb-3 d-flex w-100">
                <div class="px-3 w-50">
                    <label for="nomInput" class="form-label">Nom :</label>
                    <input required type="text" class="form-control a-verifier" name="nomInput" id="nomInput"
                           aria-describedby="nom" value="<?= $this->patient->getEtatCivil()->getNom(); ?>"
                           oninput="activerModification()">
                </div>
                <div class="px-3 w-50">
                    <label for="prenomInput" class="form-label">Prenom :</label>
                    <input required type="text" class="form-control a-verifier" name="prenomInput" id="prenomInput"
                           aria-describedby="prenom" value="<?= $this->patient->getEtatCivil()->getPrenom(); ?>"
                           oninput="activerModification()">
                </div>
            </div>
            <div class="mb-3 d-flex w-100">
                <div class="px-3 w-50">
                    <label for="civiliteInput" class="form-label">Civilite :</label>
                    <select class="form-select" id="civiliteInput" name="civiliteInput"
                            aria-label="selectionner civilite">
                        <option <?php if ($this->patient->getEtatCivil()->getCivilite() == "Monsieur") { ?> selected <?php } ?>
                                value="0">Monsieur
                        </option>
                        <option <?php if ($this->patient->getEtatCivil()->getCivilite() == "Madame") { ?> selected <?php } ?>
                                value="1">Madame
                        </option>
                    </select>
                </div>
                <div class="px-3 w-50">
                    <label for="adresseInput" class="form-label">Adresse :</label>
                    <input required type="text" class="form-control a-verifier" name="adresseInput" id="adresseInput"
                           aria-describedby="adresse" value="<?= $this->patient->getAdresse(); ?>"
                           oninput="activerModification()">
                </div>
            </div>
            <div class="mb-3 d-flex w-100">
                <div class="px-3 w-50">
                    <label for="codePostalInput" class="form-label">Code Postal :</label>
                    <input required type="number" max="999999" min="11111" maxlength="5" minlength="5"
                           class="form-control a-verifier" value="<?= $this->patient->getCodePostal(); ?>"
                           name="codePostalInput" id="codePostalInput" aria-describedby="codePostal"
                           oninput="activerModification()">
                </div>
                <div class="px-3 w-50">
                    <label for="villeInput" class="form-label">Ville :</label>
                    <input required type="text" class="form-control a-verifier" name="villeInput" id="villeInput"
                           aria-describedby="ville" value="<?= $this->patient->getVille(); ?>"
                           oninput="activerModification()">
                </div>
            </div>
            <div class="mb-3 d-flex w-100">
                <div class="px-3 w-50">
                    <label for="ddnInput" class="form-label">Date de naissance :</label>
                    <input required type="date" class="form-control a-verifier" name="ddnInput" id="ddnInput"
                           aria-describedby="ddn" value="<?= $this->patient->getDateNaissance(); ?>"
                           oninput="activerModification()">
                </div>
                <div class="px-3 w-50">
                    <label for="lieuNaissanceInput" class="form-label">Lieu de naissance :</label>
                    <input required type="text" class="form-control a-verifier" name="lieuNaissanceInput"
                           id="lieuNaissanceInput" value="<?= $this->patient->getLieuNaissance(); ?>"
                           aria-describedby="lieuNaissance" oninput="activerModification()">
                </div>
            </div>
            <div class="d-flex w-100">
                <div class="px-3 w-50">
                    <label for="nssInput" class="form-label">Numéro de sécurité sociale :</label>
                    <input required type="number" min="0" maxlength="15" minlength="15" class="form-control a-verifier"
                           name="nssInput" id="nssInput" aria-describedby="nss" value="<?= $this->patient->getNss(); ?>"
                           oninput="activerModification()">
                </div>
                <div class="px-3 w-50">
                    <label for="medecinInput" class="form-label">Medecin referrant:</label>
                    <select class="form-select" name="medecinInput" id="medecinInput"
                            aria-label="selectionner medecin">
                        <option <?php if (!$this->patient->checkReferant()) { ?> selected <?php } ?> value="null">
                            Aucun
                        </option>
                        <?php foreach ($this->medecins as $medecin): ?>
                            <option <?php if ($this->patient->checkReferant() && $this->patient->getMedecinReferrant()->getId() == $medecin->getId()) { ?> selected <?php } ?>
                                    value="<?= $medecin->getId() ?>"><?= $medecin->getEtatCivil()->getNomPrenom() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </form>
        <form method="post" action="/GererPatient" name="formSupprimer"
              id="formSupprimer">
            <input type="hidden" name="id_patient" id="id_patient" value="<?= $this->patient->getId(); ?>">
            <input type="hidden" name="action" id="action" value="supprimer">
        </form>
        <div class="mt-4 d-flex w-100">
            <button type="submit" form="formSupprimer" class="btn btn-danger form-control mx-3">Supprimer</button>
            <button disabled id="btn-validation" type="submit" form="formModifier"
                    class="btn btn-primary form-control mx-3">Modifier
            </button>
        </div>
    </div>
</div>

<script src="/static/js/verifier-elements-valides.js" defer></script>

<?php secondBlockBody(); ?>
