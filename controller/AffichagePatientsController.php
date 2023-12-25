<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.php";

class AffichagePatientsController extends Controller
{
    private array $patients;
    private array $medecins;

    public function __construct()
    {
        parent::__construct();
        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);

        require $rootDir . "/model/EtatCivil.class.php";
        require $rootDir . "/model/Patient.class.php";
        require $rootDir . "/model/Medecin.class.php";

        $this->construirePatients();
        $this->construireMedecins();

        require $rootDir . '/view/AffichagePatientsView.php';
    }

    private function construirePatients(): void
    {
        $results = $this->select(
            "SELECT * FROM Patient as p;"
        );
        $this->patients = [];
        foreach ($results as $patient) {
            $etatCivil = new EtatCivil(
                $patient["civilite"],
                $patient["nom"],
                $patient["prenom"]
            );
            $this->patients[] = new Patient($patient["id_patient"], $etatCivil, $patient["adresse"],
                $patient["code_postal"], $patient["ville"], $patient["date_naissance"], $patient["lieu_naissance"],
                $patient["nss"]);
        }
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