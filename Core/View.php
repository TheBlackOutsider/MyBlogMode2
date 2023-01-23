<?php

/**
 * View
 * php version 8.0.12 
 * framework -v 0.1
 */

namespace Core;

class View {
    
    /**
     * @param String $view - la vue à afficher ;
     * @param Array $args - tableau associatif contenant les variables à envoyer à la vue *eg: ["username" => "Jonh24"]. Pour y acceder dans la vue => echo $username;;
     */
    public static function render (string $view, array $arg = []){
        extract($arg,EXTR_SKIP);

         // relative to Core directory about type of user

        $user_path = "..\App\Views\Admin".'\\'. $view;
        $admin_path = "..\App\Views\User".'\\'. $view; 
        $error_path = "..\App\Views\Error".'\\'. $view;        

        if (is_readable($user_path)) {
          require_once $user_path;
        } elseif (is_readable($admin_path)){
            require_once $admin_path;
        }elseif (is_readable($error_path)){
            require_once $error_path;

          echo "$error_path not found";
        }
    }
}