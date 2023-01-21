<?php

namespace App\Models;

use PDO;
use PDOException;
use Core\Base\Model;

class RegisterModel extends Model{


    //etablish connexion with database
    const DB_CONNECT = static::getDB();


    /**
     * create and store an new thread
     */
    public  function create($cauthor,$clikes,$ccontent,$postrelated)
    {
        //request statements
        $req = "INSERT INTO `comments`( `user_id`, `com_likes`, `com_content`, `thread_id`) VALUES
        (
            :cauthor, 
            :clikes,    
            :ccontent,
            :postrelated
        )";
        
        //prepare and execute a request
        $prepared_stmt = self::DB_CONNECT -> prepare($req);
        try {
            
            $prepared_stmt -> execute([
                ":cauthor" => $cauthor, 
                ":clikes" => $clikes,    
                ":ccontent" => $ccontent,
                ":postrelated" => $postrelated 
            ]);
            //return a request result
            return 200;
        } catch (\PDOException $e) {
            
           return $e->getMessage();
            exit();
        }
    }


    /**
     * command to execute when user want to delete
     * @param int $id
     * @return void
     */
    public  function select($id)
    {
        //request statements
        $req = "SELECT * FROM `comments` WHERE id = $id";
        
        //prepare and execute a request
        $prepared_stmt = self::DB_CONNECT -> prepare($req);
        try {
            //initiate the model request
            $prepared_stmt -> execute();

            //return a request result
            return 200;
        } catch (\PDOException $e) {
            
           return $e->getMessage();
            exit();
        }
    }

    /**
     * command to execute when user delete
     * @param int $id
     * @return void
     */
    public  function delete($id)
    {
        //etablish connexion with database
        $db = static::getDB();

        //request statements
        $req = "SELECT * FROM `comments` WHERE id = $id";
        
        //prepare and execute a request
        $prepared_stmt = self::DB_CONNECT -> prepare($req);
        try {
            //initiate the model request
            $prepared_stmt -> execute();

            //return a request result
            return 200;
        } catch (\PDOException $e) {
            
           return $e->getMessage();
            exit();
        }
    }



}