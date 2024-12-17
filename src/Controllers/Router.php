<?php

namespace Src\Controllers;

class Router
{
    public function handleRequest()
    {
        $data = $_SERVER['REQUEST_URI'];
        $data = str_replace('/PROJET_FI', '', $data);
        $requestUri = explode("?", $data);
        $lesPOST = $requestUri[1];
        $lesPOST = explode(";", $lesPOST);
        foreach ($lesPOST as $key => $value) {
            $unPOST = explode("=", $value);
            $_POST[$unPOST[0]] = $unPOST[1];
        }
        error_log($requestUri[0]);
        


        

        switch ($requestUri[0]) {
            case '/Create_Spec':
                require_once VIEWS_PATH . '/Create_Spec.php';
                break;

            case '/rider':
                require_once VIEWS_PATH . '/rider.php';
                break;

            case '/Ac_Orga':
                require_once VIEWS_PATH . '/Liste_Spec_Orga.php';
                break;

            case '/Ac_Tech':
                require_once VIEWS_PATH . '/Liste_Spec_Tech.php';
                break;

            case '/Ac_Art':
                require_once VIEWS_PATH . '/Liste_Spec_Art.php';
                break;

            case '/Info_Art':
                require_once VIEWS_PATH . '/info_artiste.php';
                break;
            case '/Liste_S':
                require_once VIEWS_PATH . '/liste_salle.php';
                break;
            case '/insert-bd':
                require_once VIEWS_PATH . '/insert-bd.php';
                break;

            case '/ML':
                require_once VIEWS_PATH . '/mention_legal.php';
                break;

            case '/connexion_fail':
                require_once VIEWS_PATH . '/connexion.php';
                break;

            case '/':
                require_once VIEWS_PATH . '/connexion.php';
                break;

            default:
                require_once VIEWS_PATH . '/connexion.php';
                break;
        }
    }
}
