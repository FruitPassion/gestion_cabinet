<?php $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
include $rootDir . "/view/BaseView.php";
firstBlockBody();
?>

<div class="d-flex align-items-center justify-content-center" style="height: 70vh">
    <div class="w-75 mx-auto my-4">
        <h3 class="text-center mt-4">Informations du medecin :</h3>
        <form method="post" action="/GererMedecin" name="formModifier" id="formModifier"
              class="border rounded-4 py-4">
            <input type="hidden" name="id_medecin" id="id_medecin" value="<?= $this->medecin->getId(); ?>">
            <input type="hidden" name="action" id="action" value="modifier">
            <div class="d-flex w-100">
                <div class="mb-3 px-3 w-50">
                    <label for="nomInput" class="form-label">Nom :</label>
                    <input required type="text" name="nomInput" class="form-control a-verifier" id="nomInput"
                           aria-describedby="nom" value="<?= $this->medecin->getEtatCivil()->getNom(); ?>"
                           oninput="activerModification()">
                </div>
                <div class="mb-3 px-3 w-50">
                    <label for="prenomInput" class="form-label">Prenom :</label>
                    <input required type="text" name="prenomInput" class="form-control a-verifier" id="prenomInput"
                           aria-describedby="prenom" value="<?= $this->medecin->getEtatCivil()->getPrenom(); ?>"
                           oninput="activerModification()">
                </div>
            </div>
            <div class="px-3">
                <label for="civiliteInput" class="form-label">Civilite :</label>
                <select class="form-select" name="civiliteInput" id="civiliteInput" aria-label="selectionner civilite"
                        onchange="activerModification()">
                    <option <?php if ($this->medecin->getEtatCivil()->getCivilite() == "Monsieur") { ?> selected <?php } ?>
                            value="0">Monsieur
                    </option>
                    <option <?php if ($this->medecin->getEtatCivil()->getCivilite() == "Madame") { ?> selected <?php } ?>
                            value="1">Madame
                    </option>
                </select>
            </div>
        </form>
        <form method="post" action="/GererMedecin" name="formSupprimer"
              id="formSupprimer">
            <input type="hidden" name="id_medecin" id="id_medecin" value="<?= $this->medecin->getId(); ?>">
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
