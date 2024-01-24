<?php

$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.class.php";


class GererMedecinController extends Controller
{
    private array $erreurs = [];

    function __construct(array $post)
    {
        if (sizeof($post) == 0){
            $this->redirect('/AffichageMedecins', false);
        }
        parent::__construct();

        switch($post["action"]){
            case "ajouter":
                $this->checkDataCreationMedecin($post);
                break;
            case "modifier":
                $this->checkDataModificationMedecin($post);
                break;
            case "supprimer":
                $this->supprimerMedecin($post);
                break;
        }

        if (count($this->erreurs) > 0) {
            $_SESSION["erreurs"] = $this->erreurs;
        }

        $this->redirect('/AffichageMedecins', false);
    }

    private function insererMedecin($post) : void {
        $this->insertUpdateDelete(
            "INSERT INTO Medecin (nom, prenom, civilite) VALUE (?, ?, ?);",
            [
                $post["nomInput"],
                $post["prenomInput"],
                $post["civiliteInput"]
            ]
        );
    }

    private function updateMedecin($post) : void {
        $this->insertUpdateDelete(
            "UPDATE Medecin
        SET nom = ?, prenom = ?, civilite = ? WHERE id_medecin = ?", [
            $post["nomInput"],
            $post["prenomInput"],
            $post["civiliteInput"],
            $post["id_medecin"]]
        );
    }

    private function supprimerMedecin($post) : void {
        $this->insertUpdateDelete(
            "DELETE FROM RendezVous WHERE id_medecin = ?", [$post["id_medecin"]]
        );
        $this->insertUpdateDelete(
            "UPDATE Patient
        SET id_medecin = ? WHERE id_medecin = ?", [
                null,
                $post["id_medecin"]]
        );
        $this->insertUpdateDelete(
            "DELETE FROM Medecin WHERE id_medecin = ?", [$post["id_medecin"]]
        );
    }

    private function checkDataCreationMedecin($post) : void {
        $this->checkDataMedecin($post);
        if (count($this->erreurs) == 0) {
            $this->insererMedecin($post);
        }
    }

    private function checkDataModificationMedecin($post) : void {
        $this->checkDataMedecin($post);
        $this->checkMedecinExist($post);
        if (count($this->erreurs) == 0) {
            $this->updateMedecin($post);
        }
    }

    private function checkDataMedecin($post): void
    {
        if (empty($post["nomInput"])) {
            $this->erreurs[] = "Le nom du médecin est obligatoire";
        }
        if (empty($post["prenomInput"])) {
            $this->erreurs[] = "Le prénom du médecin est obligatoire";
        } elseif ($post["civiliteInput"] != 1 && $post["civiliteInput"] != 0) {
            $this->erreurs[] = "La civilité du médecin est invalide";
        }
    }

    private function checkMedecinExist($post): void
    {
        $medecin = $this->selectFirst("SELECT * FROM Medecin WHERE id_medecin = ?;", [$post["id_medecin"]]);
        if ($medecin == null) {
            $this->erreurs[] = "Le médecin n'existe pas";
        }
    }


}
