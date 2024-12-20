<?php

namespace Src\Controllers;

class Router
{

    public function handleRequest()
    {
        session_start();

        $data = $_SERVER['REQUEST_URI'];
        $data = str_replace('/PROJET_FI', '', $data);
        $requestUri = explode("?", $data);
        $lesPOST = $requestUri[1];
        $lesPOST = explode(";", $lesPOST);
        foreach ($lesPOST as $key => $value) {
            $unPOST = explode("=", $value);
            $_POST[$unPOST[0]] = $unPOST[1];
        }



        switch ($requestUri[0]) {
            case '/ADM':
                require_once VIEWS_PATH . '/admin.php';
                break;
            case '/List_asso':
                require_once VIEWS_PATH . '/List_asso.php';
                break;


                case '/crea_Asso':
                    require_once CONTROLLERS_PATH . '/crea_Asso.php';
                    break;

            case "/Compte":
                require_once VIEWS_PATH . '/compte.php';
                break;
            
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

            case '/tentative_co':
                require_once CONTROLLERS_PATH . '/tentative_co.php';
                break;

            case '/info-rider':
                require_once CONTROLLERS_PATH . '/info-rider.php';
                break;

            case '/changement_mdp':
                require_once CONTROLLERS_PATH . '/changement_mdp.php';
                break;

            case '/ML':
                require_once VIEWS_PATH . '/mention_legal.php';
                break;

            case '/Cmdp':
                require_once VIEWS_PATH . '/page-changement-mdp.php';
                break;

            case '/chan-mdp-reussi':
                $_SESSION['mdp-bool'] = "reussi";
                require_once VIEWS_PATH . '/page-changement-mdp.php';
                break;

            case '/rate-diff-mdp':
                $_SESSION['mdp-bool'] = "diff";
                require_once VIEWS_PATH . '/page-changement-mdp.php';
                break;

            case '/rate-meme-mdp':
                $_SESSION['mdp-bool'] = "meme";
                require_once VIEWS_PATH . '/page-changement-mdp.php';
                break;

            case '/Create_ART':
                require_once VIEWS_PATH . '/Crea_ART.php';
                break;

            case '/Create_ART2':
                require_once VIEWS_PATH . '/Create_ART.php';
                break;

            case '/Create_Salle':
                require_once VIEWS_PATH . '/Create_Salle.php';
                break;

            case '/Create_Salle2':
                require_once VIEWS_PATH . '/Create_Salle2.php';
                break;


            case '/erreur_Creation_Spectacle':
                require_once VIEWS_PATH . '/problème-Crea-spec.php';
                break;
                

            case '/Create_Spec2':
                require_once VIEWS_PATH . '/page-creation-spectacle2.php';
                break;

            case '/connexion_fail':
                $_SESSION['connexion_fail'] = true;
                header("Location: /");
                exit;

            case "/salles_dipo":
                require_once VIEWS_PATH . '/liste_salle_dispo.php';
                break;

            case "/verif_artiste":
                require_once CONTROLLERS_PATH . '/verification_artiste.php';
                break;

            case "/mauvais_artiste":
                require_once VIEWS_PATH . '/Create_Spec.php';
                break;

            case "/creer_specacle":
                require_once VIEWS_PATH . '/creation_spec.php';
                break;

            case '/':
                require_once VIEWS_PATH . '/connexion.php';
                break;

            default:
                header("Location: /");
                exit;
        }
    }
}
