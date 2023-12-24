<?php

#[AllowDynamicProperties] class AffichagePatientsController {

    function __construct(){
        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]) . '/gestion_cabinet/';

        require $rootDir."model/DB.class.php";
        require $rootDir."model/Patient.class.php";

        $_DB = new DB();
        $this->results = $_DB->select(
            "SELECT * FROM Patient as p;"
        );

        require $rootDir.'view/AffichagePatientsView.php';
    }

}