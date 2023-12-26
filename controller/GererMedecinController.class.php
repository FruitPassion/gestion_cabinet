<?php

$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.class.php";


class GererMedecinController extends Controller
{
    function __construct(array $post)
    {
        if (sizeof($post) == 0){
            $this->redirect('/AffichageMedecins', false);
        }
        parent::__construct();
        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);

        require $rootDir . "/model/EtatCivil.class.php";
        require $rootDir . "/model/Patient.class.php";
        require $rootDir . "/model/Medecin.class.php";

        switch($post["action"]){
            case "ajouter":
                $this->insererMedecin($post);
                break;
            case "modifier":
                $this->updateMedecin($post);
                break;
            case "supprimer":
                $this->supprimerMedecin($post);
                break;
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
}
