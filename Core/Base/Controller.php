<?php

/**
 * Base Controller
 * php version 8.0.12 
 * framework -v 0.1
 */

namespace Core\Base;

class Controller {
    
    //set default params
    public $id;
    public ?array $params;

    public function __construct($id = null, $params = null)
    {
        $this->id = $id;
        $this->params = $params;
    }

    function sanitize(string $data):string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}