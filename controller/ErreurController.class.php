<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.class.php";

class ErreurController extends Controller
{
    private string $message;

    function __construct(array $post)
    {
        parent::__construct();
        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);

        $this->message = $post['error'];

        require $rootDir . '/view/ErreurView.php';

    }

}