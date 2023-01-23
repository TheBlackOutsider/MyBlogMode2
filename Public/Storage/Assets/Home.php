<?php

namespace App\Controllers;

use Core\Base\BaseController;
use \Core\View;

/**
 * Home controller
 * 
 * PHP version 8.1.12
 */
class Home extends BaseController
{
  /**
   * Show the index page
   * 
   * @return void
   */
  public function index()
  {
    View::render("/index.php");
  }

  public function search()
  {
    echo "searching";
  }
}
