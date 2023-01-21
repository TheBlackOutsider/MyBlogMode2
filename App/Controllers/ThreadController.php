<?php

namespace App\Controllers;
use Core\Base\Controller;
use \Core\View;

/**
 * Builder controller
 * 
 * PHP version 8.1.12
 */
class ThreadController extends Controller {



  /**
   * Show the index page
   * @return void
   */
  public function index() {
    View::render("threads.php");
  }


  /**
   * Show the index page   * 
   * @return void
   */
  public function create() {
    View::render("Public/Admin/dashboard/.php");
  }

  public function getUpdate($id) {
    echo "searching";
    $updated = ThreadModel::update();
    
    View::render("Public/Admin/dashboard.php");

  }

  public function getView($id) {
    echo "searching";
    View::render("Public/review.php");

  }

}