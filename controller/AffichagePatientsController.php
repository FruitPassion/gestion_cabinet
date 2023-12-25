<?php

#[AllowDynamicProperties] class AffichagePatientsController
{

    function __construct()
    {
        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]) . '/gestion_cabinet/';

        require $rootDir . "model/DB.class.php";
        require $rootDir . "model/EtatCivil.class.php";
        require $rootDir . "model/Patient.class.php";
        require $rootDir . "model/Medecin.class.php";

        $_DB = new DB();
        $this->results = $_DB->select(
            "SELECT * FROM Patient as p;"
        );
        $this->patients = [];
        foreach ($this->results as $patient) {
            $etatCivil = new EtatCivil(
                $patient["civilite"],
                $patient["nom"],
                $patient["prenom"]
            );
            $this->patients[] = new Patient($patient["id_patient"], $etatCivil, $patient["adresse"],
                $patient["code_postal"], $patient["ville"], $patient["date_naissance"], $patient["lieu_naissance"],
                $patient["nss"]);
        }

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

        require $rootDir . 'view/AffichagePatientsView.php';
    }

}