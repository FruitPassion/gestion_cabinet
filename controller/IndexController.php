<?php

class IndexController {

    function __construct(){

        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]) . '/gestion_cabinet/';

        require $rootDir.'view/IndexView.php';

    }

}