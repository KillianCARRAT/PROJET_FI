<?php

namespace Src\Controllers;

class Router
{
    public function handleRequest()
    {
        $requestUri = $_SERVER['REQUEST_URI'];

        $requestUri = str_replace('/PROJET_FI', '', $requestUri);

        switch ($requestUri) {
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

            case '/':
                require_once VIEWS_PATH . '/connexion.php';
                break;

            default:
                require_once PUBLIC_PATH . '/connexion.php';
                break;
        }
    }
}
