<?php

namespace App\Http;

class Request{
    /**
     * Método HTTP da requisição
     * @var string
     */
    private $httpMethod;

    /**
     * URI da página
     * @var string
     */
    private $uri;
    
    /**
     * Parâmetros  da URL ($_GET)
     * @var array
     */
    private $queryParams = [];

    /**
     * Variáveis recebidas no POST da página ($_POST)
     * @var array
     */
    private $postVars = [];

    /**
     * Cabeçalho da requisição
     * @ array
     */
    private $headers;

    public function __construct(){
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? [];
        $this->uri = $_SERVER['REQUEST_URI'] ?? [];
    }

    /**
     * Método responsável por retornar o método HTTP da requisição
     * @return string
     */
    public function getHttpMethod(){
        return $this->httpMethod;
    }

    /**
     * Método responsável por retornar o URI da requisição
     * @return string
     */
    public function getHttpUri(){
        return $this->uri;
    }

    /**
     * Método responsável por retornar os headers da requisição
     * @return string
     */
    public function getHeaders(){
        return $this->headers;
    }

    /**
     * Método responsável por retornar os QueryParams da requisição
     * @return string
     */
    public function getQueryParams(){
        return $this->queryParams;
    }

    /**
     * Método responsável por retornar os postVars da requisição
     * @return string
     */
    public function getPostVars(){
        return $this->postVars;
    }





}