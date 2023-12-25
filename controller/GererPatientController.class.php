<?php

$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.class.php";


class GererPatientController extends Controller
{
    function __construct(array $post)
    {
        if (sizeof($post) == 0) {
            $this->redirect('/?action=AffichagePatients', false);
        }
        parent::__construct();
        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);

        require $rootDir . "/model/EtatCivil.class.php";
        require $rootDir . "/model/Patient.class.php";
        require $rootDir . "/model/Medecin.class.php";

        switch ($post["action"]) {
            case "ajouter":
                $this->insererPatient($post);
                break;
            case "modifier":
                $this->updatePatient($post);
                break;
            case "supprimer":
                $this->supprimerPatient($post);
                break;
        }

        $this->redirect('/?action=AffichagePatients', false);
    }

    private function insererPatient($post): void
    {
        if ($post["medecinInput"] == "null") {
            $post["medecinInput"] = null;
        }
        $this->insertUpdateDelete(
            "INSERT INTO Patient (nom, prenom, civilite, adresse, code_postal, ville, date_naissance, 
            lieu_naissance, nss, id_medecin) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);",
            [
                $post["nomInput"],
                $post["prenomInput"],
                $post["civiliteInput"],
                $post["adresseInput"],
                $post["codePostalInput"],
                $post["villeInput"],
                $post["ddnInput"],
                $post["lieuNaissanceInput"],
                $post["nssInput"],
                $post["medecinInput"]
            ]
        );
    }

    private function updatePatient($post): void
    {
        if ($post["medecinInput"] == "null") {
            $post["medecinInput"] = null;
        }
        $this->insertUpdateDelete(
            "UPDATE Patient
        SET nom = ?, prenom = ?, civilite = ?, adresse = ?, code_postal = ?, ville = ?, date_naissance = ?, 
            lieu_naissance = ?, nss = ?, id_medecin = ? WHERE id_patient = ?", [
            $post["nomInput"],
            $post["prenomInput"],
            $post["civiliteInput"],
            $post["adresseInput"],
            $post["codePostalInput"],
            $post["villeInput"],
            $post["ddnInput"],
            $post["lieuNaissanceInput"],
            $post["nssInput"],
            $post["medecinInput"],
            $post["id_patient"]]);
    }

    private function supprimerPatient($post): void
    {
        $this->insertUpdateDelete(
            "DELETE FROM RendezVous WHERE id_patient = ?", [$post["id_patient"]]
        );
        $this->insertUpdateDelete(
            "DELETE FROM Patient WHERE id_patient = ?", [$post["id_patient"]]
        );
    }
}

new GererPatientController($_POST);