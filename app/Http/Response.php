<?php

namespace App\Http;

class Response{
    /**
     * Código do Status HTTP
     * @var integer
     */
    private $httpCode = 200;

    /**
     * Cabeçalho do Response
     * @var array
     */
    private $headers = [];

    /**
     * Tipo de conteúdo que será retornado
     * @var string
     */
    private $contentType = "text/html";

    /**
     * Conteúdo do response
     * @var mixed
     */
    private $content;

    /**
     * Método responsável por iniciar a classe e definir os valores
     * @param integer $httpCode
     * @param mixed $content
     * @param string $contentType
     */
    public function __construct($httpCode,$content,$contentType = 'text/html'){
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);        
    }

    /**
     * Método responsável por laterar o ContentType do Response 
     * @param string $contentType
    */
    public function setContentType($contentType){
        $this->contentType = $contentType;
        $this->addHeader('Content-Type',$contentType);
    }

    /**
     * Método responsável por adicionar um registro no cabeçalho de response
     * @param string $key
     * @param string $value
     */
    public function addHeader($key, $value){
        $this->headers[$key] = $value;
    }

    /**
     * Método responsável por enviar os Headers ao navegador     
     */
    private function sendHeaders(){
        //Status
        http_response_code($this->httpCode);

        //Enviar headers
        foreach($this->headers as $key=>$value){
            header($key.': '.$value);
        }
    }

    /**
     * Método responsável por enviar a resposta para o usuário
     */
    public function sendResponse(){
       // Envia os headers
       $this->sendHeaders();

    //    Imprime o Conteúdo 
       switch($this->contentType) {
        case 'text/html';
            echo $this->content;
            exit;
       }
    }




}