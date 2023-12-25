<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.php";

class AjouterPatientController extends Controller
{

    public function __construct(array $post)
    {
        if (sizeof($_POST) == 0){
            $this->redirect('/?action=AffichagePatients', false);
        }
        parent::__construct();
        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);

        require $rootDir . "/model/EtatCivil.class.php";
        require $rootDir . "/model/Patient.class.php";
        require $rootDir . "/model/Medecin.class.php";

        $this->insererPatient($post);

        $this->redirect('/?action=AffichagePatients', false);
    }

    private function insererPatient($post) : void {

        $this->insertOrUpdate(
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
}

new AjouterPatientController($_POST);