<?php

class AffichageController {

    function __construct(){

        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]) . '/gestion_cabinet/';

        $this->msg = "oui";
        require $rootDir.'view/AffichageView.php';

    }

}