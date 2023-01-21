<?php

namespace Core\Exceptions;
use Core\View;

class FatalException {

    private $error;

    public function __construct($error, $code)
    {
        View::render("Errors/error.php", 
            [
                "msgType" => "error",
                "msg" => $error,
                "code" => $code
            ]);
            exit;
    }

    public function __destruct()
    {
        exit;
    }

}
