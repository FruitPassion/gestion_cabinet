<?php $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
include $rootDir . "/view/BaseView.php";
firstBlockBody();
?>

<div class="d-flex align-items-center justify-content-center" style="height: 80vh">
    <div class="w-75 mx-auto my-4">

        <h3 class="text-center mt-4">Informations du patient :</h3>
        <form name="formModifier" id="formModifier" class="w-75 mx-auto my-4" method="post" action="/GererRendezVous">
            <input type="hidden" name="action" id="action" value="modifier">
            <div class="d-flex w-100">
                <div class="mb-3 px-3 w-50">
                    <label for="patient" class="form-label">Patient :</label>
                    <input type="text" class="form-control" name="patient" id="patient"
                           aria-describedby="nss" value="<?= $this->rdv->getPatient()->getEtatCivil()->getNomPrenom() ?>"
                           readonly>
                    <input type="hidden" name="patientInput" id="patientInput"
                            value="<?= $this->rdv->getPatient()->getId(); ?>">
                </div>
                <div class="mb-3 px-3 w-50">
                    <label for="medecin" class="form-label">Medecin :</label>
                    <input type="text" class="form-control" name="medecin" id="medecin"
                           aria-describedby="nss" value="<?= $this->rdv->getMedecin()->getEtatCivil()->getNomPrenom() ?>"
                           readonly>
                    <input type="hidden" name="medecinInput" id="medecinInput"
                           value="<?= $this->rdv->getMedecin()->getId(); ?>">
                </div>
            </div>
            <div class="d-flex w-100">
                <div class="mb-3 px-3" style="width: 33%">
                    <label for="dateInput" class="form-label">Date du rendez-vous :</label>
                    <input required type="date" class="form-control a-verifier"
                           name="dateInput" id="dateInput" aria-describedby="nss" value="<?= $this->rdv->getDate() ?>"
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
                            <option value="<?= sprintf("%02d", $heure) . ":" . sprintf("%02d", $minute) . ":00" ?>"
                                    <?php if ((sprintf("%02d", $heure) . ":" . sprintf("%02d", $minute) . ":00") == $this->rdv->getHeure()) echo "selected" ?>>
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
                        <option value="15" <?php if ($this->rdv->getDuree() == 15) echo "selected" ?>
                        >15 minutes</option>
                        <option value="30" <?php if ($this->rdv->getDuree() == 30) echo "selected" ?>
                        >30 minutes</option>
                        <option value="45" <?php if ($this->rdv->getDuree() == 45) echo "selected" ?>
                        >45 minutes</option>
                        <option value="60" <?php if ($this->rdv->getDuree() == 60) echo "selected" ?>
                        >1 heure</option>
                    </select>
                </div>
            </div>
        </form>
        <form method="post" action="/GererRendezVous" name="formSupprimer" id="formSupprimer">
            <input type="hidden" name="patientInput" id="patientInput" value="<?= $this->rdv->getPatient()->getId(); ?>">
            <input type="hidden" name="medecinInput" id="medecinInput" value="<?= $this->rdv->getMedecin()->getId(); ?>">
            <input type="hidden" name="dateInput" id="dateInput" value="<?= $this->rdv->getDate(); ?>">
            <input type="hidden" name="heureInput" id="heureInput" value="<?= $this->rdv->getHeure(); ?>">
            <input type="hidden" name="action" id="action" value="supprimer">
        </form>
        <div class="mt-4 d-flex w-100">
            <button type="submit" form="formSupprimer" class="btn btn-danger form-control mx-3">Supprimer</button>
            <button id="btn-validation" type="submit" form="formModifier"
                    class="btn btn-primary form-control mx-3">Modifier
            </button>
        </div>
    </div>
</div>


<?php secondBlockBody(); ?>
