<?php

/**
 * BaseController
 * php version 8.0.12 
 * framework -v 0.1
 */

namespace Core\Base;

class BaseController {
    
    public $id;
    public ?array $params;

    public function __construct($id = null, $params = null)
    {
        $this->id = $id;
        $this->params = $params;
    }
}