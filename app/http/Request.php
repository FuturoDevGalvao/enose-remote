<?php

declare(strict_types=1);

namespace app\http;

class Request
{
    /**
     * método HTTP da requisição 
     * @var string
     */
    private string $method;

    /**
     * URI da página
     * @var string
     */
    private string $uri;

    /**
     * Parâmetros da requisição ($_GET)
     * @var array
     */
    private $queryParams = [];

    /**
     * Parâmetros recebidos no POST da página ($_POST)
     * @var array
     */
    private $postVars = [];

    /**
     * cabeçalho da requisição
     * @var array
     */
    private $headers = [];

    public function __construct()
    {
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->method = $_SERVER["REQUEST_METHOD"] ?? "";
        $this->uri = $_SERVER["REQUEST_URI"] ?? "";
    }

    public function getMethod(): string
    {
        return  strtolower($this->method);
    }

    public function getURI(string $type): string
    {
        return parse_url($this->uri)[$type];
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function getPostVars(): array
    {
        return $this->postVars;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function clearParams()
    {
        $this->postVars = [];
        $this->queryParams = [];
    }
}
