<?php

namespace App\Controllers;

use Core\Base\Controller;
use App\Models\GetUserModel;
use Core\Exceptions\FatalException;
use \Core\View;

/**
 * Login controller
 * 
 * PHP version 8.1.12
 */
class LoginController extends Controller
{
  /**
   * Show the index page
   * 
   * @return void
   */
  public function index()
  {
    View::render("/login.php");
  }

  public function login()
  {

    //get posted data
    $data = $this->params['data'];

    if ($data) {
      //get user with user
      $responses = GetUserModel::list($this->sanitize($data['email']));

      //Check if request has result (are found user);
      if (is_countable($responses) && count($responses) === 0) {
        View::render("/login.php", [
          "msgType" => "error",
          "msg" => "Identifiant invalide !",
          "code" => null
        ]);
        exit();
      }

      //Check if request return exception and display it
      if (is_string($responses)) {
        new FatalException($responses, 500);
      }

      //check if password match
      if (is_countable($responses) && password_verify($data['pwd'], $responses[0]['user_pwd'])) {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $_SESSION["user_id"] = $responses[0]["user_id"];
        $_SESSION["user_profil"] = strtoupper($responses[0]["user_fname"][0] . $responses[0]["user_lname"][0]);
        $_SESSION["user_name"] = $responses[0]["user_fname"];
        $_SESSION["user_role"] = $responses[0]["role_id"];
      } else {
        View::render("/login.php", [
          "msgType" => "error",
          "msg" => "Mot de passe invalide !",
          "code" => null
        ]);
        exit();
      }
      //render a homepage
      View::render("/index.php");
    } else {

      View::render("/login.php", [
        "msgType" => "error",
        "msg" => "Veuillez remplir tout les champs !",
        "code" => null
      ]);
      exit;
    }
  }

  public function logout()
  {
    //log out a current user
    if (session_status() === PHP_SESSION_NONE) session_start();
    session_unset();
    session_destroy();

    //render a homepage
    View::render("/index.php");
  }
}
