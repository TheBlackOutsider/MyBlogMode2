<?php

namespace App\Controllers;
use Core\Base\Controller;
use \App\Models\GetUserEmailModel;
use \Core\View;

/**
 * get user controller
 * 
 * PHP version 8.1.12
 */
class GetUserEmailController extends Controller
{

    public static function list()
    {
      
        //Get content type 
        $contentType = trim($_SERVER["CONTENT_TYPE"] ?? ''); 
        
        // Send error to Fetch API, if unexpected content type 
        if ($contentType !== "application/json")
            die(json_encode([
                'code' => 400,
                'msg' => 'Content-Type is not set as "application/json"',
                'data' => null,
            ]));

        // Receive the RAW post data.
        $content = trim(file_get_contents("php://input"));

        //$decode data
        $decoded = json_decode($content, true);

        //Send error to Fetch API, if JSON is broken
        if (!is_array($decoded))
            die(json_encode([
                'code' => 400,
                'msg' => 'Received JSON is improperly formatted',
                'data' => null,
            ]));

        //fetch database with decoded data
        $data = GetUserEmailModel::list(htmlspecialchars($decoded['payload']));

        //check if database return result anad user are founded
         if (is_countable($data) && count($data) > 0) {
             /* Send success to fetch API */
            die(json_encode([
                'code' => 200,
                'msg' => "succes",
                'data' => $data
            ]));
        }

        //Check if request has result and user are not found);
        if (is_countable($data) && count($data) === 0) {
            die(json_encode([
                'code' => 404,
                'msg' => "user not found",
                'data' => null
            ]));
        }

        //Check if request return exception and display it
        if (is_string($data)) {
            echo $data;
        }  
    }

}
