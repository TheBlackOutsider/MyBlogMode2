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
    public  function create($title, $describ, $imaged, $video, $content)
    {

        //request statements
        $req = "INSERT INTO `threads`( `thread_title`, `thread_title`, `thread_describ`, `thread_image`, `thread_video`, `thread_content`) VALUES
        (
            :title, 
            :describ,    
            :imaged,
            :video,
            :content,
        )";
        
        //prepare and execute a request
        $prepared_stmt = self::DB_CONNECT -> prepare($req);

        try {
            
            $prepared_stmt -> execute([
                ":title" => $title, 
                ":describ" => $describ,    
                ":imaged" => $imaged,
                ":video" => $video,
                ":content" => $content 
            ]);

            //return a request result
            return 200;
        } catch (\PDOException $e) {
            
           return $e->getMessage();
            exit();
        }
    }



    /**
     * command to execute when user want to select all elements
     * @param int $id
     * @return void
     */
    public  function selectAll()
    {
        //request statements
        $req = "SELECT * FROM `threads` WHERE id = $id";
        
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
     * command to execute when user want to select one element
     * @param int $id
     * @return void
     */
    public  function selectAll()
    {
        //request statements
        $req = "SELECT * FROM `threads` WHERE id = $id";
        
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
     * command to execute when user want to delete
     * @param int $id
     * @return void
     */
    public  function delete($id)
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


}