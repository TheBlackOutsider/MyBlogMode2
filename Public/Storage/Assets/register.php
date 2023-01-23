<?php

namespace App\Controllers;

use Core\Base\BaseController;
use \Core\View;

/**
 * Register controller
 * 
 * PHP version 8.1.12
 */
class Register extends BaseController
{
  /**
   * Show the index page
   * 
   * @return void
   */
  public function index()
  {
    View::render("/register.php");
  }

  public function register()
  {
    $data = $_POST;
    die(json_encode([
      $data
    ]));
  }
}
