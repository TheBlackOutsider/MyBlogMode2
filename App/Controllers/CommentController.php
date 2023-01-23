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
class CommentController extends Controller
{
  /**
   * Show the index page
   * 
   * @return void
   */
  public function index()
  {
    $comment = CommentModel::create();
    View::render("/thread.php");
  }

  public function getUpdate($id)
  {
    echo "searching";
    View::render("/review.php");
  }

  public function getView($id)
  {
    echo "searching";

    View::render("/review.php");
  }
}
