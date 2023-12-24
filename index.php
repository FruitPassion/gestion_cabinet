<?php

function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);
    exit();
}

$action = $_GET['action'];
if (!isset($action)){
    Redirect('?action=Index', false);
}

/* Decoupe l'url en liste */
$action_list = explode('/', $action);

if (isset($action) && isset($action_list[0])) {
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



