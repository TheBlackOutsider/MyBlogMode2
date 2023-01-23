<?php

/**
 * Router
 * php version 8.0.12 
 * framework -v 0.1
 */

namespace Core\Router;
use Core\Exceptions\FatalException;
use \Core\View;

class Router
{
    private $routes = [];
    private $data = [];

    //method that will be called if request method is get
    public function get($path, $callable){
        return $this->add($path ?? null, $callable, 'GET', ["data" => $this->data ?? null, "files" => $_FILES ?? null]);
    }
     //method that will be called if request method is post
    public function post($path, $callable){
        return $this->add($path, $callable, 'POST', ["data" => $_POST ?? null, "files" =>$_FILES ?? null]);
    }
    //add route in routing table 
    private function add($path, $callable, $method, $data){
        $route = new Route($path, $callable, $data);
        $this->routes[$method][] = $route;
        return $route;
    }

    //dispatch a request
    public function dispatch($url){
      
        $url = $this->cutParams($url);
        //check if method exist
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            // throw exception
             new FatalException('REQUEST_METHOD does not exist', 501);
             exit;
        }

        //if http method exist call controller dynamicaly
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            if($route->match($url)){
                // echo $route->match($url);
                // exit;
                return $route->call();
            }
        }
        
        // return 404 page view if route not match
         View::render("Errors/404.php");
         exit;
    }

    /**
   * Remove query parameter eg: home?index=2 => home
   * @param String $url
   * @return String $url return sanitize url *eg: home?id=2&name=doe ==> home
   */
  private function cutParams($url)
  {   
    
    $url = rtrim($url, '/');

    $url = explode('&', $url);
    
    //get data eg: home?id=2&name=doe => [id => 2, name => doe]
    if (count($url) > 1) {

        //retrieve a part of url that not contain parameter
        $softUrl = array_shift($url);

        for($i=0; $i < count($url); $i++){
            
            $fragment = explode('=', $url[$i]);

            //add a parameter to data array like param [param1 => val1, paramN => val N]
            $this->data[$fragment[0]] = $fragment[1];
            return $softUrl;
        }
    }
    //return sanitize url *eg: home?id=2&name=doe => home
    return $url[0] ?? $url;
  }



  /**
   * Remove query parameter eg: home?index=2 => home
   * @param String $url
   * @return String $url return sanitize url *eg: home?id=2&name=doe ==> home
   */
  public function getDatas() {
    return $this->data;     
  }



}