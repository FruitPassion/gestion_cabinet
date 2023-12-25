<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.class.php";

class StatistiquesController extends Controller
{
    private Planning $planning;
    private array $stats;

    function __construct(array $post)
    {
        parent::__construct();

        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
        require $rootDir."/model/Planning.class.php";

        $this->planning = new Planning(
            $this->selectAll("SELECT * FROM Medecin as m;"),
            $this->selectAll("SELECT * FROM Patient as p;"),
            $this->selectAll("SELECT * FROM RendezVous as r;")
        );

        $this->stats = $this->planning->calculerStats();

        require $rootDir.'/view/StatistiquesView.php';

    }

}