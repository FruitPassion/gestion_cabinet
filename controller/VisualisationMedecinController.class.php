<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.class.php";

class VisualisationMedecinController extends Controller
{
    private Medecin $medecin;

    function __construct(array $post)
    {
        if (sizeof($post) == 0) {
            $this->redirect('/?action=AffichageMedecins', false);
        }
        parent::__construct();

        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
        require $rootDir . "/model/EtatCivil.class.php";
        require $rootDir . "/model/Medecin.class.php";
        $this->construireMedecin($post["id_medecin"]);

        require $rootDir . '/view/VisualisationMedecinView.php';
    }

    private function construireMedecin(string $idMedecin): void
    {
        $result = $this->selectFirst(
            "SELECT * FROM Medecin as m WHERE id_medecin = ?;", [$idMedecin]
        );

        $etatCivil = new EtatCivil(
            $result["civilite"],
            $result["nom"],
            $result["prenom"]
        );
        $this->medecin = new Medecin($result["id_medecin"], $etatCivil);
    }
}