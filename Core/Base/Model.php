<?php

/**
 * Base Model
 * php version 8.0.12 
 * framework -v 0.1
 */

namespace Core\Base;

use PDO;
use \Core\View;
use PDOException;
use Config\Env;


class Model
{
    public static function getDB()
    {

        //get database connection info
        $host = Env::DB_HOST;
        $dbname = Env::DB_NAME;
        $username = Env::DB_USER;
        $pwd = Env::DB_PASSWORD;


        try {
            //etablish connection to database
            return new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $pwd);

            
        } catch (PDOException $e) {
            //if error occurs return error view
            View::render("Errors/error.php", 
            [
                "msgType" => "error",
                "msg" => $e->getMessage()
            ]);
            exit;
        }
    }

    /**
     * magic method use to execute any request initiated
     * a the data which is collected by the request
     */
    public static function __executeRequest($req, $var = [])
    {

        //etablish connexion with database
        $dbconnection = self::getDB();

        $prp_stmt = $dbconnection -> prepare($req);

        try {
            
            $prp_stmt -> execute($var);
            
            $prp_stmt-> fetchAll(PDO::FETCH_ASSOC);
            //return a request result
            // \print_r($var);
            return 200;
        } catch (\PDOException $e) {
            
           return $e->getMessage();
            exit();
        }



        
    }
}
