<?php

namespace App\Controllers;

use Core\Base\BaseController;
use \Core\View;

/**
 * Login controller
 * 
 * PHP version 8.1.12
 */
class Login extends BaseController
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
    echo "searching";
  }
}
