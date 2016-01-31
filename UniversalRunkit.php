<?php
namespace Codeception\Lib\Connector;

use Symfony\Component\BrowserKit\Client;
use Symfony\Component\BrowserKit\Response;

class UniversalRunkit extends Client
{
  use Shared\PhpSuperGlobalsConverter;

  protected $index;

  public function setIndex($index)
  {
      $this->index = $index;
  }

  public function doRequest($request)
  {
      $sandbox = new \Runkit_Sandbox();
      $sandbox->_COOKIE = $request->getCookies();
      $sandbox->_SERVER = $request->getServer();
      $sandbox->_FILES = $this->remapFiles($request->getFiles());

      $uri = str_replace('http://localhost', '', $request->getUri());

      $sandbox->_REQUEST = $this->remapRequestParameters($request->getParameters());
      if (strtoupper($request->getMethod()) == 'GET') {
          $sandbox->_GET = $sandbox->_REQUEST;
      } else {
          $sandbox->_POST = $sandbox->_REQUEST;
      }

      $sandbox->eval('$_SERVER["REQUEST_METHOD"] = "'. strtoupper($request->getMethod()) . '";');
      $sandbox->eval('$_SERVER["REQUEST_URI"] = "' . $uri . '";');
      $sandbox->eval('$_SERVER["argv"] = ["index.php", "' . $uri . '"];');
      $sandbox->eval('$_SERVER["PHP_SELF"] = "index.php";');

      $sandbox->define('STDIN', true);

      ob_start();
      $sandbox->include($this->index);

      $content = ob_get_contents();
      ob_end_clean();

      $headers = [];
      $php_headers = headers_list();
      foreach ($php_headers as $value) {
          // Get the header name
          $parts = explode(':', $value);
          if (count($parts) > 1) {
              $name = trim(array_shift($parts));
              // Build the header hash map
              $headers[$name] = trim(implode(':', $parts));
          }
      }
      $headers['Content-type'] = isset($headers['Content-type']) ? $headers['Content-type'] : "text/html; charset=UTF-8";

      $response = new Response($content, 200, $headers);
      return $response;
  }

}
