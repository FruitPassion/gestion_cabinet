<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.class.php";

class VisualisationRendezVousController extends Controller
{
    private Planning $planning;
    private RendezVous $rdv;

    private array $infos = [];

    public function __construct(array $post)
    {
        if (sizeof($post) == 0) {
            $this->redirect('/AffichageMedecins', false);
        }
        parent::__construct();

        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
        require $rootDir."/model/Planning.class.php";


        $this->planning = new Planning(
            $this->selectAll("SELECT * FROM Medecin as m;"),
            $this->selectAll("SELECT * FROM Patient as p;"),
            $this->selectAll("SELECT * FROM RendezVous as r;")
        );

        $this->infos = $post;

        $this->rdv = $this->planning->getRendezVousParInfos($this->infos["id_medecin"], $this->infos["id_patient"], $this->infos["date_rdv"]);

        require $rootDir . '/view/VisualisationRendezVousView.php';
    }


}