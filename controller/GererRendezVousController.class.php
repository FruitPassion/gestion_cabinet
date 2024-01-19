<?php

$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.class.php";


class GererRendezVousController extends Controller
{
    private array $erreurs = [];

    /**
     * @throws Exception
     */
    function __construct(array $post)
    {
        if (sizeof($post) == 0) {
            $this->redirect('/AffichageRendezVous', false);
        }
        parent::__construct();

        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
        require $rootDir."/model/EtatCivil.class.php";
        require $rootDir."/model/Patient.class.php";
        require $rootDir."/model/Medecin.class.php";

        switch ($post["action"]) {
            case "ajouter":
                $this->checkDataRendezVous($post);
                if (count($this->erreurs) == 0) {
                    $this->insererRendezVous($post);
                }
                break;
            case "modifier":
                $this->checkDataRendezVous($post);
                if (count($this->erreurs) == 0) {
                    $this->updateRendezVous($post);
                }
                break;
            case "supprimer":
                $this->supprimerRendezVous($post);
                break;
        }

        if (count($this->erreurs) > 0) {
            $_SESSION["erreurs"] = $this->erreurs;
        }

        echo "<pre>";
        var_dump($post);
        echo "</pre>";

        $this->redirect('/AffichageRendezVous', false);
    }

    private function insererRendezVous(array $post): void
    {
        $this->insertUpdateDelete(
            "INSERT INTO RendezVous (date, heure, duree, id_medecin, id_patient) VALUE (?, ?, ?, ?, ?);",
            [
                $post["dateInput"],
                $post["heureInput"],
                $post["dureeInput"],
                $post["medecinInput"],
                $post["patientInput"]
            ]
        );
    }

    private function updateRendezVous(array $post): void
    {
        $this->insertUpdateDelete(
            "UPDATE RendezVous
        SET date = ?, heure = ?, duree = ? WHERE id_medecin = ? AND id_patient = ?", [
            $post["dateInput"],
            $post["heureInput"],
            $post["dureeInput"],
            $post["medecinInput"],
            $post["patientInput"]]
        );
    }

    private function supprimerRendezVous(array $post): void
    {
        $this->insertUpdateDelete(
            "DELETE FROM RendezVous WHERE id_medecin = ? AND id_patient = ? AND date = ? AND heure = ?;",
            [
                $post["medecinInput"],
                $post["patientInput"],
                $post["dateInput"],
                $post["heureInput"]
            ]
        );
    }

    /**
     * @throws Exception
     */
    private function checkDataRendezVous(array $post): void
    {
        $this->checkDate($post);
        $this->checkHeure($post);
        $this->checkDuree($post);
        $this->checkMedecin($post);
        $this->checkPatient($post);
    }

    /**
     * @throws Exception
     */
    private function checkDate(array $post): void
    {
        // check if date is valid and not in the past
        if (!preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $post["dateInput"])) {
            $this->erreurs[] = "La date n'est pas valide";
        } else {
            $date = explode("-", $post["dateInput"]);
            if (!checkdate($date[1], $date[2], $date[0])) {
                $this->erreurs[] = "La date n'est pas valide";
            } else {
                $date = new DateTime($post["dateInput"]);
                $now = new DateTime();
                if ($date < $now) {
                    $this->erreurs[] = "La date ne peut pas être dans le passé";
                }
            }
        }
    }

    private function checkHeure(array $post): void
    {
        if (!preg_match("/^(0[9]|1[0-6]):(00|30):00$/", $post["heureInput"])) {
            $this->erreurs[] = "L'heure n'est pas valide";
        }
    }

    private function checkDuree(array $post): void
    {
        if (!preg_match("/^(15|30|45|60)$/", $post["dureeInput"])) {
            $this->erreurs[] = "La durée n'est pas valide";
        }
    }

    private function checkMedecin(array $post): void
    {
        $results = $this->selectAll(
            "SELECT * FROM Medecin as m WHERE m.id_medecin = ?;",
            [$post["medecinInput"]]
        );
        if (count($results) != 1) {
            $this->erreurs[] = "Le médecin n'existe pas";
        }
    }

    private function checkPatient(array $post): void
    {
        $results = $this->selectAll(
            "SELECT * FROM Patient as p WHERE p.id_patient = ?;",
            [$post["patientInput"]]
        );
        if (count($results) != 1) {
            $this->erreurs[] = "Le patient n'existe pas";
        }
    }
}
