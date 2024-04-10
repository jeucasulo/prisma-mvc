<?php

namespace App\Http;

use \Closure;
use \Exception;

class Router{
    /**
     * URL completa do projeto (raiz)
     * @var string
     */
    private $url = '';

    /**
     * Prefixo de todas as rotas
     * @var string
     */
    private $prefix = 'asdfasf';

    /**
     * Índice de rotas
     * @var array
     */
    private $routes = [];

    /**
     * Instancia da class Request
     * @var Request
     */
    private $request;

    /**
     * Método responsável por iniciar a classe
     * @param string $url
     */
    public function __construct($url){
        $this->request = new Request();
        $this->url = $url;
        $this->setPrefix();
    }
    /**
     * Método responsável por definir o prefixo das rotas
     */
    private function setPrefix(){
        //Informações da URL
        $parseUrl = parse_url($this->url);

        //Define o prefix
        $this->prefix = $parseUrl['path'] ?? '';
    }

    /**
     * Método responsável por adicionar uma rota na classe
     * @param string $method
     * @param string $route
     * @param array $params
     */
    private function addRoute($method,$route,$params = []){
        //Validação dos parâmetros
        foreach($params as $key=>$value){
            if($value instanceof Closure){
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        // Padrão de validação da URL
        // $patternRoute = '/^'.str_replace('/','\/',$route).'$/';
        $patternRoute = '/^'.str_replace('/', '\/', $route).'$/';

        // echo "<pre>";
        // print_r($patternRoute);
        // echo "</pre>";

        // Adiciona a rota dentro da classe
        $this->routes[$patternRoute][$method] = $params;
        // echo "<pre>";
        // print_r($this);
        // echo "</pre>";


    }

    /**
     * Método responsável por definir uma rota de POST
     * @param string $route
     * @param array $params
     */        
    public function post($route, $params = []){
        return $this->addRoute('POST',$route,$params);
    }
    /**
     * Método responsável por definir uma rota de PUT
     * @param string $route
     * @param array $params
     */        
    public function put($route, $params = []){
        return $this->addRoute('PUT',$route,$params);
    }
    
    /**
     * Método responsável por definir uma rota de DELETE
     * @param string $route
     * @param array $params
     */        
    public function delete($route, $params = []){
        return $this->addRoute('DELETE',$route,$params);
    }
    
    /**
     * Método responsável por definir uma rota de GET
     * @param string $route
     * @param array $params
     */        
    public function get($route, $params = []){
        return $this->addRoute('GET',$route,$params);
    }
    
    /**
     * Método responsável por retornar a URI desconsiderando o prefixo
     * @return string
     */
    private function getUri(){
        //Uri da request
        $uri = $this->request->getHttpUri();

        //Fatia a URI com o prefixo
        $xUri = strlen($this->prefix)?explode($this->prefix,$uri):[$uri];

        // Retorna a URI sem o prefixo
        return end($xUri);
    }
    
    /**
     * Método responsável por retornar os dados da rota atual
     * @return array
     */
    public function getRoute(){
        //uri
        $uri = $this->getUri();

        //Method
        $httpMethod = $this->request->getHttpMethod();

        // Valida as rotas
        foreach($this->routes as $patternRoute=>$methods){
            echo("---");
            echo("<pre>");
            print_r($this->routes);
            echo("</pre>");
            exit;
        if(preg_match($patternRoute, $uri)){
            // Verifica o método
            if($methods[$httpMethod]){
                return $methods[$httpMethod];
            }
            throw new Exception("Método não permitido",405);
        }

        }

        throw new Exception("URL não encontrada",1);



    }

    /**
     * Método responsável por executar a rota atual
     * @return Response
     */
    public function run(){
        try {           
            // Obtém a rota atual 
            $route = $this->getRoute();
            // throw new Exception("Página não encontrada",404);
        } catch (Exception $e) {
            //throw $th;
            return new Response($e->getCode(),$e->getMessage());
        }
    }




}