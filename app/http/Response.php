<?php

declare(strict_types=1);

namespace app\http;

class Response
{
    /**
     * Código do satus HTTP 
     * @var int 
     */
    private int $httpCode = 200;

    /**
     * Cabeçalho do Response
     * @var array
     */
    private array $headers = [];

    /**
     * Tipo de conteúdo que será está sendo retornado
     * @var string
     */
    private string $contentType = "text/html";

    /**
     * Conteúdo do Response
     * @var mixed
     */
    private mixed $content;

    public function __construct(int $httpCode, mixed $content, string $contendType = "text/html")
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contendType);
    }

    /**
     * Método responsável por alterar o content type do response
     * @param string $contentType
     */
    public function setContentType(string $contentType)
    {
        $this->contentType = $contentType;
        $this->addHeader("Content-Type", $contentType);
    }

    /**
     * @param string $key
     * @param string $value
     * */
    public function addHeader(string $key, string  $value)
    {
        $this->headers[$key] = $value;
    }

    public function sendResponse()
    {
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit;
        }
    }
}
