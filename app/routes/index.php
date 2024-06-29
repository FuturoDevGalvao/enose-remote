<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use app\core\Router;

/* 
  ["REQUEST_URI"]: podemos usar o request uri para basear nosso roteamento, porém, dessa forma 
  não é possível obter possíveis query params. Portanto, podemos fazer uso do método parse_url
  para contornar esse problema.

  ex: parse_url($_SERVER["REQUEST_URI"])
*/

Router::execute();
