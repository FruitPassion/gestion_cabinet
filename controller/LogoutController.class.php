<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.class.php";

class LogoutController extends Controller
{
    public function __construct(array $post)
    {
        parent::__construct();
        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);

        session_start();
        session_destroy();
        $this->redirect('/Login', false);
    }
}