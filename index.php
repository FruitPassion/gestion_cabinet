<?php

function Redirect($url, $permanent = false): void
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);
    exit();
}

# On demarre la session
session_start();

# On initialise l'utilisateur
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = 'visiteur';
    Redirect('Login', false);
}

# On recupere l'action
$action = $_GET['action'];
if (str_contains($_SERVER['REQUEST_URI'], "?action=")) {
    Redirect($action, false);
}

# On verifie que l'utilisateur a le droit d'acceder a la page
if (!isset($action) && $_SESSION['user'] == 'visiteur') {
    Redirect('Login', false);
} elseif (isset($action) && (!in_array($action, ["Login", "VerifierLogin"])) && $_SESSION['user'] == 'visiteur') {
    Redirect('Login', false);
} elseif (!isset($action) && $_SESSION['user'] == 'user') {
    Redirect('Index', false);
}

# On initialise le theme
if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = 'dark';
}

# On change le theme
if (isset($_POST['clair'])) {
    $_SESSION['theme'] = 'light';
} elseif (isset($_POST['sombre'])) {
    $_SESSION['theme'] = 'dark';
}

# On recupere le controller
$action_list = explode('/', $action);

# On verifie que l'action existe
if (isset($action_list[0])) {

    $controller_name = $action_list[0] . 'Controller';

    try {
        error_reporting(E_ERROR | E_PARSE);
        require 'controller/' . $controller_name . '.class.php';

        $controller = new $controller_name($_POST);
    } catch (Error $e) {
        require 'controller/ErreurController.class.php';

        $controller = new ErreurController(['error' => $e->getMessage()]);
        # Redirect('Erreur', false);
    }
}


