<?php

namespace App\Controllers;

use Core\Base\Controller;
use \Core\View;

/**
 * Builder controller
 * 
 * PHP version 8.1.12
 */
class BuilderController extends Controller
{
  /**
   * Show the index page
   * 
   * @return void
   */
  public function index()
  {
    View::render("/builder.php");
  }

  public function search()
  {
    echo "searching";
  }
}
