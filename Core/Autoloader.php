<?php
  /**
   * Autoloader
   * php version 8.0.12 
   * framework -v 0.1
   */

   class Autoloader{

    public static function register ()
    {
      spl_autoload_register(function($class){
        $root = str_replace("\\", DIRECTORY_SEPARATOR, dirname(__DIR__));
        $file = $root. '\\' . str_replace("\\", DIRECTORY_SEPARATOR, $class) . '.php';

        if(file_exists($file)){
          require $file;
          return true;
        }
        
        echo "class '$class' not found";
        return false;
      });
    }
   }
