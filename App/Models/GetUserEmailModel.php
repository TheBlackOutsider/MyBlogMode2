<?php

namespace App\Models;
use PDO;
use Core\Base\Model;

class GetUserEmailModel extends Model{


        //etablish connexion with database
        // const DB_CONNECT = static::getDB();


     /**
     * add general 
     */
    public static function list($email)
    {
        //etablish connexion with database
        // $db = static::getDB();

        //request statements
        $req = "SELECT user_email FROM `users` WHERE  `users`.`user_email` = :email";
        
        //prepare and execute a request
        // $prepared_stmt = self::DB_CONNECT -> prepare($req);

        // try {
            
            $var =[
                ":email" => $email
            ];
            //return a request result
            // return $prepared_stmt -> fetchAll(PDO::FETCH_ASSOC);
        // } catch (\PDOException $e) {
            
        //    return "error ".$e->getMessage();
        //     exit();
        // }

            static::__executeRequest($req, $var);


    }
}