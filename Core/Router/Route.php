<?php

/**
 * Routes file
 * php version 8.0.12 
 * framework -v 0.1
 */

namespace Core\Router;
use \Core\View;

class Route
{
 
  //controller
  private $path;
  //method
  private $callable;
  //route params
  public $params = [];
  //query parts that match a route
  private $matches;

  public function __construct($path, $callable, $data){
      $this->path = trim($path, '/'); 
      $this->callable = $callable;
      $this->params ["data"] = $data["data"];
      $this->params ["files"] = $data["files"];
  }

  /**
   * call dynamically a new controller with approppriate method
   */
  public function call(){

    if(is_array($this->callable)){

      //extract a controller
      $controller = array_keys($this->callable)[0];
      //extract method
      $action = $this->callable[$controller];
      //format controller
      $controller = "\App\Controllers\\$controller";
      //instanciate new controller
      $controller_obj = new $controller($this -> params["id"] ?? null, $this->params);
      //return a line that will'be call  controller method
      return $controller_obj -> $action();

    }
    
  }

  public function match($url){
    $url = trim($url, '/');
    $path = preg_replace_callback('#:([\w]+)#', [$this, 'match_params'], $this->path);
    $regex = "#^$path$#i";
    if(preg_match($regex, $url, $matches)){
      array_shift($matches);
      $this->matches = $matches;
      return true;
    }
    return false;
  }

  
  //
  public function with($param, $regex){
    $this->params[$param] = str_replace('(', '(?:', $regex);
    return $this; // On retourne tjrs l'objet pour enchainer les arguments
  }


  private function match_params($match){

    if(isset($this->params[$match[1]])){
        return '(' . $this->params[$match[1]] . ')';
    }
    return '([^/]+)';

  }

  public function getUrl($params){

    $path = $this->path;
    foreach($params as $k => $v){
        $path = str_replace(":$k", $v, $path);
    }
    return $path;
  }

}