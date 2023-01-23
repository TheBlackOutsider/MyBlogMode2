<?php

namespace App\Controllers;

use Core\Base\BaseController;

use \Core\View;

/**
 * UpdateAccount controller
 * 
 * PHP version 8.1.12
 */
class UpdateAccount extends BaseController
{
  /**
   * Show the index page
   * 
   * @return void
   */
  public function index()
  {
    View::render("/update.php");
  }

  public function update()
  {
    echo "searching";
  }
}
