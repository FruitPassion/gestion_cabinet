<?php

function Redirect($url, $permanent = false): void
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);
    exit();
}

/* On demarre la session */
session_start();

/* On initialise l'utilisateur */
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = 'visiteur';
    Redirect('Login', false);
}


/* On recupere l'action */
$action = $_GET['action'];
if (str_contains($_SERVER['REQUEST_URI'], "?action=")) {
    Redirect($action, false);
}


if (!isset($action) && $_SESSION['user'] == 'visiteur'){
    Redirect('Login', false);
} elseif (isset($action) && (!in_array($action, ["Login", "VerifierLogin"]) ) && $_SESSION['user'] == 'visiteur') {
    Redirect('Login', false);
} elseif (!isset($action) && $_SESSION['user'] == 'user') {
    Redirect('Index', false);
}


if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = 'dark';
}


if (isset($_POST['clair'])) {
    $_SESSION['theme'] = 'light';
} elseif (isset($_POST['sombre'])) {
    $_SESSION['theme'] = 'dark';
}


$action_list = explode('/', $action);

if (isset($action_list[0])) {

    $controller_name = $action_list[0] . 'Controller';

    try {
        require 'controller/'. $controller_name . '.class.php';

        $controller = new $controller_name($_POST);
    } catch (Error $e) {
         # echo ($e->getMessage());
        Redirect('Erreur', false);
    }
}


