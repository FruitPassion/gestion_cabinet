<?php

#[AllowDynamicProperties] class AffichageMedecinsController {

    function __construct(){
        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]) . '/gestion_cabinet/';

        require $rootDir."model/DB.class.php";
        require $rootDir."model/Medecin.class.php";

        $_DB = new DB();
        $this->results = $_DB->select(
            "SELECT * FROM Medecin as p;"
        );

        require $rootDir.'view/AffichageMedecinsView.php';
    }

}