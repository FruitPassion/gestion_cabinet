<?php

$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.class.php";


class GererPatientController extends Controller
{
    private array $erreurs = [];
    
    function __construct(array $post)
    {
        if (sizeof($post) == 0) {
            $this->redirect('/AffichagePatients', false);
        }
        parent::__construct();


        switch ($post["action"]) {
            case "ajouter":
                $this->checkDataCreationPatient($post);
                break;
            case "modifier":
                $this->checkDataModificationPatient($post);
                break;
            case "supprimer":
                $this->supprimerPatient($post);
                break;
        }

        if (count($this->erreurs) > 0) {
            $_SESSION["erreurs"] = $this->erreurs;
        }

        $this->redirect('/AffichagePatients', false);
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

    private function checkDataCreationPatient(array $post): void
    {
        $this->checkDataPatient($post);
        if (count($this->erreurs) == 0) {
            $this->insererPatient($post);
        }
    }

    private function checkDataPatient(array $post): void
    {
        if (strlen($post["nomInput"]) == 0) {
            $this->erreurs[] = "Le nom ne peut pas être vide";
        }
        if (strlen($post["prenomInput"]) == 0) {
            $this->erreurs[] = "Le prénom ne peut pas être vide";
        }
        if (strlen($post["civiliteInput"]) == 0) {
            $this->erreurs[] = "La civilité ne peut pas être vide";
        } elseif ($post["civiliteInput"] != 1 && $post["civiliteInput"] != 0) {
            $this->erreurs[] = "La civilité n'est pas valide";
        }
        if (strlen($post["adresseInput"]) == 0) {
            $this->erreurs[] = "L'adresse ne peut pas être vide";
        }
        if (strlen($post["codePostalInput"]) == 0) {
            $this->erreurs[] = "Le code postal ne peut pas être vide";
        }
        if (strlen($post["villeInput"]) == 0) {
            $this->erreurs[] = "La ville ne peut pas être vide";
        }
        if (strlen($post["ddnInput"]) == 0) {
            $this->erreurs[] = "La date de naissance ne peut pas être vide";
        } elseif (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $post["ddnInput"])) {
            $this->erreurs[] = "La date de naissance n'est pas valide";
        } elseif (strtotime($post["ddnInput"]) > strtotime(date("Y-m-d"))) {
            $this->erreurs[] = "La date de naissance ne peut pas être dans le futur";
        }
        if (strlen($post["lieuNaissanceInput"]) == 0) {
            $this->erreurs[] = "Le lieu de naissance ne peut pas être vide";
        }
        if (strlen($post["nssInput"]) == 0) {
            $this->erreurs[] = "Le numéro de sécurité sociale ne peut pas être vide";
        }
        if (($post["medecinInput"] != "aucun") && (!$this->checkMedecinExist($post))) {
            $this->erreurs[] = "Le médecin n'existe pas";
        }
    }

    private function checkDataModificationPatient(array $post): void
    {
        $this->checkDataPatient($post);
        $this->checkPatientExist($post);
        if (count($this->erreurs) == 0) {
            $this->updatePatient($post);
        }
    }

    private function checkMedecinExist($post): bool
    {
        if ($post["medecinInput"] != "aucun") {
            return true;
        }
        $medecin = $this->selectFirst("SELECT * FROM Medecin WHERE id_medecin = ?;", [$post["medecinInput"]]);
        if ($medecin == null) {
            return false;
        }
        return true;
    }

    private function checkPatientExist($post): void
    {
        $patient = $this->selectFirst("SELECT * FROM Patient WHERE id_patient = ?;", [$post["id_patient"]]);
        if ($patient == null) {
            $this->erreurs[] = "Le patient n'existe pas";
        }
    }
}
