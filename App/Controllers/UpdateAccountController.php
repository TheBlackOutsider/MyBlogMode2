<?php

namespace App\Controllers;
use Core\Base\Controller;

use \Core\View;

/**
 * UpdateAccount controller
 * 
 * PHP version 8.1.12
 */
class UpdateAccountController extends Controller {
  /**
   * Show the index page
   * 
   * @return void
   */
  public function index() {
    View::render("Public/update.php");
  }

  public function update() {
    echo "searching";
  }
  
}