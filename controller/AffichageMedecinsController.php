<?php

#[AllowDynamicProperties] class AffichageMedecinsController {

    function __construct(){
        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);

        require $rootDir."/model/DB.class.php";
        require $rootDir."/model/EtatCivil.class.php";
        require $rootDir."/model/Medecin.class.php";

        $_DB = new DB();
        $this->results = $_DB->select(
            "SELECT * FROM Medecin as m;"
        );
        $this->medecins = [];
        foreach ($this->results as $medecin) {
            $etatCivil = new EtatCivil(
                $medecin["civilite"],
                $medecin["nom"],
                $medecin["prenom"]
            );
            $this->medecins[] = new Medecin($medecin["id_medecin"], $etatCivil);
        }

        require $rootDir.'/view/AffichageMedecinsView.php';
    }

}