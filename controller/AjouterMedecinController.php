<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.php";


class AjouterMedecinController extends Controller
{

    function __construct(array $post)
    {
        if (sizeof($post) == 0){
            $this->redirect('/?action=AffichageMedecins', false);
        }
        parent::__construct();
        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);

        require $rootDir . "/model/EtatCivil.class.php";
        require $rootDir . "/model/Patient.class.php";
        require $rootDir . "/model/Medecin.class.php";

        $this->insererMedecin($post);

        $this->redirect('/?action=AffichageMedecins', false);
    }

    private function insererMedecin($post) : void {
        $this->insertOrUpdate(
            "INSERT INTO Medecin (nom, prenom, civilite) VALUE (?, ?, ?);",
            [
                $post["nomInput"],
                $post["prenomInput"],
                $post["civiliteInput"]
            ]
        );
    }
}

new AjouterMedecinController($_POST);
