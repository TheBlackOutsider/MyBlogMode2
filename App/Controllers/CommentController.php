<?php

namespace App\Controllers;
use Core\Base\Controller;
use App\Models\CommentModel;
use \Core\View;

/**
 * Builder controller
 * 
 * PHP version 8.1.12
 */
class CommentController extends Controller {
  /**
   * Show the index page
   * 
   * @return void
   */
  public function index() {
    $comment = CommentModel::create();
    View::render("Public/thread.php");
  }

  public function getUpdate($id) {
    echo "searching";
    View::render("Public/review.php");

  }

  public function getView($id) {
    echo "searching";

    View::render("Public/review.php");

  }



}