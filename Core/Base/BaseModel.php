<?php

/**
 * BaseModel
 * php version 8.0.12 
 * framework -v 0.1
 */

namespace Core\Base;

use App\Config\Config;
use PDO;
use PDOException;
use \Core\View;


class BaseModel
{
    public static function getDB()
    {

        $host = Config::DB_HOST;
        $dbname = Config::DB_NAME;
        $username = Config::DB_USER;
        $pwd = Config::DB_PASSWORD;

        try {
            return new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $pwd);
            //    print_r($db);
            //    exit();
        } catch (PDOException $e) {
            
            View::render("Errors/error.php", 
            [
                "msgType" => "error",
                "msg" => $e->getMessage()
            ]);
            exit;
        }
    }
}
