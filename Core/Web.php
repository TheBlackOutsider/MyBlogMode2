<?php
    namespace Core;


    class Web {

        public static function get($router){

            $router->get('/', ["HomeController" => "index"]); 
            $router->get('/home', ["HomeController" => "index"]); 
            $router->get('/index', ["HomeController" => "index"]); 
            $router->get('/thread', ["ThreadController" => "index"]); 
            $router->get('/thread/view', ["ThreadController" => "getView"]); 
            $router->get('/thread/update', ["ThreadController" => "getUpdate"]); 
            $router->get('/feedback', ["FeedBackController" => "index"]); 

            $router->get('/sign-in', ["LoginController" => "index"]); 
            $router->post('/login', ["LoginController" => "login"]); 
            $router->get('/logout', ["LoginController" => "logout"]); 
            
            $router->get('/sign-up', ["RegisterController" => "index"]); 
            $router->post('/register', ["RegisterController" => "register"]); 

            $router->get('/update', ["UpdateAccountController" => "index"]); 
            $router->post('/update', ["UpdateAccountController" => "update"]); 

            $router->post('/getUserEmail', ["GetUserEmailController" => "list"]); 

            // $router->get('/posts/:id', function($id){ echo "Voila l'article $id"; }); 

        }

}