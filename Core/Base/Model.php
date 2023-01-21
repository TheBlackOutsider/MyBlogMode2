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
use App\Config\Env;


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
     * @param mixed $req
     * @return 
     * a the data which is collected by the request
     */
    public static function __executeRequest($req)
    {

        //etablish connexion with database
        $dbconnection = self::getDB();

        $prp_stmt = $dbconnection -> prepare($req)

        try {
            
            $prepared_stmt -> execute([
                ":fname" => $fname, 
                ":lname" => $lname,    
                ":email" => $email,
                ":pwd" => $pwd, 
                ":mysecret" => $secret 
                ":bday" => $bday 
            ]);
            //return a request result
            return 200;
        } catch (\PDOException $e) {
            
           return $e->getMessage();
            exit();
        }
    }
}
