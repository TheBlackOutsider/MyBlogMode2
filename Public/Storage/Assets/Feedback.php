<?php

namespace App\Controllers;

use Core\Base\BaseController;
use \Core\View;

/**
 * Feedback controller
 * 
 * PHP version 8.1.12
 */
class Feedback extends BaseController
{
  /**
   * Show the index page
   * 
   * @return void
   */
  public function index()
  {
    View::render("/feedback.php");
  }

  public function search()
  {
    echo "searching";
  }
}
