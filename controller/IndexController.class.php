<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.class.php";
class IndexController extends Controller
{
    function __construct(array $post){
        parent::__construct();

        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);

        require $rootDir.'/view/IndexView.php';

    }

}