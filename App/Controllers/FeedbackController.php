<?php

namespace App\Controllers;
use Core\Base\Controller;
use \Core\View;

/**
 * Feedback controller
 * 
 * PHP version 8.1.12
 */
class FeedbackController extends Controller {
  /**
   * Show the index page
   * 
   * @return void
   */
  public function index() {
    View::render("Public/feedback.php");
  }

  public function search() {
    echo "searching";
  }

}