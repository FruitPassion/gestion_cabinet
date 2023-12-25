<?php $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
include $rootDir . "/view/BaseView.php";
firstBlockBody();
?>
<div class="d-flex align-items-center justify-content-center" style="height: 70vh">
    <div class="w-50 m-auto">
        <h3 class=" mt-4">Répartition des usagers :</h3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Tranche d'âge</th>
                <th scope="col" class="text-center">Nb Hommes</th>
                <th scope="col" class="text-center">Nb Femmes</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Moins de 25 ans</th>
                <td class="text-center"><?php echo $this->stats["moins25"]["homme"] ?></td>
                <td class="text-center"><?php echo $this->stats["moins25"]["femme"] ?></td>
            </tr>
            <tr>
                <th scope="row">Entre 25 et 50 ans </th>
                <td class="text-center"><?php echo $this->stats["entre25et50"]["homme"] ?></td>
                <td class="text-center"><?php echo $this->stats["entre25et50"]["femme"] ?></td>
            </tr>
            <tr>
                <th scope="row">Plus de 50 ans</th>
                <td class="text-center"><?php echo $this->stats["plus50"]["homme"] ?></td>
                <td class="text-center"><?php echo $this->stats["plus50"]["femme"] ?></td>
            </tr>
            </tbody>
        </table>
        <h3 class=" mt-4">Durée totale des consultations :</h3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Médecin</th>
                <th scope="col" class="text-center">Heures de consutations effectuées</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($this->planning->getMedecins() as $medecin) { ?>
                <tr>
                    <th scope="row"><?= $medecin->getEtatCivil()->getNomPrenom() ?></th>
                    <td class="text-center"><?= $medecin->getNbHeuresConsultations() ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php secondBlockBody(); ?>
