<?php

function Redirect($url, $permanent = false): void
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);
    exit();
}

/* On recupere l'action */
$action = $_GET['action'];
if (!isset($action)){
    Redirect('?action=Index', false);
}

/* On demarre la session */
session_start();
/* On initialise le theme */
if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = 'dark';
}
/* On recupere le theme */
if (isset($_POST['clair'])) {
    $_SESSION['theme'] = 'light';
} elseif (isset($_POST['sombre'])) {
    $_SESSION['theme'] = 'dark';
}

/* Decoupe l'url en liste */
$action_list = explode('/', $action);

if (isset($action_list[0])) {
    /* On trouve le nom du controleur */
    $controller_name = $action_list[0] . 'Controller';

    try {
        require 'controller/'. $controller_name . '.php';
        /* On instancie le controleur */
        $controller = new $controller_name;
    } catch (Error $e) {
        Redirect('?action=Erreur', false);
    }
}



