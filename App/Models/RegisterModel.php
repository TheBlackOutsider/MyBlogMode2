<?php

namespace App\Models;

use PDO;
use PDOException;
use Core\Base\Model;

class RegisterModel extends Model
{

    //etablish connexion with database
    // const DB_CONNECT = static::getDB();


    /**
     * register user
     */
    public  function register($fname, $lname, $email, $pwd, $secret , $bday)
    {

        //request statements
        $req = "INSERT INTO `users`( `role_id` `user_fname`, `user_lname`, `user_email`, `user_pwd`,`user_secret` `user_birthday`) VALUES
        (
            :roleid,
            :fname, 
            :lname,    
            :email,
            :pwd,
            :mysecret,
            :bday
        )";

        //prepare and execute a request
        // $prepared_stmt = self::DB_CONNECT -> prepare($req);

        $var = [
            ":roleid" => "0001",
            ":fname" => $fname,
            ":lname" => $lname,
            ":email" => $email,
            ":pwd" => $pwd,
            ":mysecret" => $secret,
            ":bday" => $bday
        ];


        static::__executeRequest($req, $var);


    }
}
