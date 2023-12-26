<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
require $rootDir . "/controller/Controller.class.php";

class VerifierLoginController extends Controller
{
    private string $login;
    private string $password;

    public function __construct(array $post)
    {
        parent::__construct();
        $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);

        require $rootDir . "/model/Utilisateur.class.php";

        $this->login = $post["inputLogin"];
        $this->password = $post["inputPassword"];

        $this->verifierUtilisateur();
    }

    private function verifierUtilisateur(): void
    {
        $results = $this->selectAll(
            "SELECT * FROM Utilisateur as u WHERE u.login = ? AND u.password = ?;",
            [$this->login, $this->password]
        );
        session_start();

        if (count($results) == 1) {
            $_SESSION['user'] = 'user';
            $this->redirect('/Index', false);
        } else {
            $_SESSION['login_try'] = 'failed';
            $this->redirect('/Login', false);
        }
    }
}