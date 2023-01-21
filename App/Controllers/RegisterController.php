<?php

namespace App\Controllers;
use Core\Base\Controller;
use App\Models\RegisterModel;
use Core\View;

/**
 * Register controller
 * 
 * PHP version 8.1.12
 */
class RegisterController extends Controller {
  /**
   * Show the index page
   * 
   * @return void
   */
  public function index() {
    View::render("Public/register.php");
  }

  public function register() {
 
    //get posted data
    $data = $this->params["data"];

    if (
      isset($data["fname"]) && !empty($data["fname"])
      && isset($data["lname"]) && !empty($data["lname"])
      && isset($data["email"]) && !empty($data["email"])
      && filter_var($data["email"], FILTER_VALIDATE_EMAIL)
      && isset($data["pwd"]) && !empty($data["pwd"])
      ) {
        $fname = $this->sanitize($data["fname"]);
        $lname = $this->sanitize($data["lname"]);
        $email = $this->sanitize($data["email"]);
        $pwd = password_hash($this->sanitize($data["pwd"]), PASSWORD_DEFAULT);


        $register = new RegisterModel();
        $response = $register->register($fname, $lname, $email, $pwd, password_hash(bin2hex(random_bytes(2)), PASSWORD_DEFAULT));
        
      
         //check if request succeced
         if ( $response === 200) {
            die(json_encode([
              'code' => 200,
              'msg' => "succes",
              'data' => null,
            ]));
          }
      
        //display error if request fail 
        //error type is string but succes result is array 
        if (is_string($response)) {
          die(json_encode([
            'code' => 500,
            'msg' => $response,
            'data' => null,
        ]));
        }

    }else {
      die(json_encode([
        'code' => 422,
        'msg' => 'Champs invalides!',
        'data' => null,
    ]));
    }
  }


   
  

  
}