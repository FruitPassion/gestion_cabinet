<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.class.php";

class LoginController extends Controller
{
    public bool $loginFailed = false;

    public function __construct(array $post)
    {
        parent::__construct();
        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
        
        if (isset($_SESSION['login_try']) && $_SESSION['login_try'] == 'failed') {
            unset($_SESSION['login_try']);
            $this->loginFailed = true;
            header('HTTP/1.0 403 Forbidden');
        }

        require $rootDir . "/view/LoginView.php";
    }
}