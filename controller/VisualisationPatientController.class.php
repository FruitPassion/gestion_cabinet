<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.class.php";

class VisualisationPatientController extends Controller
{
    private Patient $patient;
    private array $medecins;

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

        $this->construireMedecins();
        $this->construirePatient($post["id_patient"]);

        require $rootDir . '/view/VisualisationPatientView.php';
    }

    private function construirePatient(string $idPatient): void
    {
        $result = $this->selectFirst(
            "SELECT * FROM Patient WHERE id_patient = ?;", [$idPatient]
        );

        $etatCivil = new EtatCivil(
            $result["civilite"],
            $result["nom"],
            $result["prenom"]
        );
        $this->patient= new Patient($result["id_patient"], $etatCivil, $result["adresse"],
            $result["code_postal"], $result["ville"], $result["date_naissance"], $result["lieu_naissance"],
            $result["nss"]);
        if ($result["id_medecin"] != null) {
            $this->patient->definirReferant($this->medecins[$result["id_medecin"] - 1]);
        }
    }

    private function construireMedecins(): void
    {
        $results = $this->selectAll(
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