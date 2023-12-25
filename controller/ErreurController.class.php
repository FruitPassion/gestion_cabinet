<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.class.php";

class ErreurController extends Controller
{
    function __construct(array $post)
    {
        parent::__construct();

        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);

        require $rootDir . '/view/404.php';

    }

}