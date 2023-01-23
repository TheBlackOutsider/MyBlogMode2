<?php

namespace App\Controllers;

use Core\Base\Controller;
use App\Models\StoreCvModel;
use Core\View;

/**
 * Register controller
 * 
 * PHP version 8.1.12
 */
class StoreCvController extends Controller
{
    /**
     * Show the index page
     * 
     * @return void
     */
    public function index()
    {
        View::render("/register.php");
    }

    public function store()
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

        die(json_encode([
            $decoded, $this->id
        ]));
        //Send error to Fetch API, if JSON is broken
        if (!is_array($decoded))
            die(json_encode([
                'code' => 400,
                'msg' => 'Received JSON is improperly formatted',
                'data' => null,
            ]));

        // $cvid = ;
        // $cvname = ;
        // $model = ;
        // $picture = ;
        // $user = ;
        //fetch database with decoded data
        $data = StoreCvModel::store($cvid, $cvname, $model, htmlspecialchars($decoded['payload']), $picture, $user);

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
