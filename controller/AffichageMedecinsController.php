<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.php";

class AffichageMedecinsController extends Controller{
    private array $medecins;

    function __construct(){
        parent::__construct();

        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
        require $rootDir."/model/EtatCivil.class.php";
        require $rootDir."/model/Medecin.class.php";

        $this->construireMedecins();

        require $rootDir.'/view/AffichageMedecinsView.php';
    }

    private function construireMedecins(): void
    {
        $results = $this->select(
            "SELECT * FROM Medecin as m;"
        );
        $this->medecins = [];
        foreach ($results as $medecin) {
            $etatCivil = new EtatCivil(
                $medecin["civilite"],
                $medecin["nom"],
                $medecin["prenom"]
            );
            $this->medecins[] = new Medecin($medecin["id_medecin"], $etatCivil);
        }
    }

}