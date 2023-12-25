<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.php";

class ErreurController extends Controller
{
    function __construct()
    {
        parent::__construct();

        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);

        require $rootDir . '/view/404.php';

    }

}