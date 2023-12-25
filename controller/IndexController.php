<?php

class IndexController {

    function __construct(){

        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);

        require $rootDir.'/view/IndexView.php';

    }

}