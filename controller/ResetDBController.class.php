<?php

$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.class.php";


class ResetDBController extends Controller
{
    function __construct(array $post)
    {
        parent::__construct();

        $this->resetDataBase();

        $this->redirect('/AffichageMedecins', false);
    }

}

