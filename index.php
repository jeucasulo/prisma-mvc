<?php 

require __DIR__.'/vendor/autoload.php';


use \App\Controller\Pages\Home;
use \App\Http\Response;
use \App\Http\Router;


define('URL','http://localhost:8000/');

$obRouter = new Router(URL);
// Routa home
$obRouter->post('/',[
    function(){
        return new Response(200,Home::getHome());
    }
]);

// Imprime response da rota
$obRouter->run()->sendResponse();
