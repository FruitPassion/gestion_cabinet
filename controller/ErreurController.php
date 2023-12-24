<?php

class ErreurController
{

    function __construct()
    {

        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]) . '/gestion_cabinet/';

        require $rootDir . 'view/404.php';

    }

}