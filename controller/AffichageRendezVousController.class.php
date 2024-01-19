<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.class.php";

class AffichageRendezVousController extends Controller
{
    private Planning $planning;

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

        require $rootDir.'/view/AffichageRendezVousView.php';

    }

}