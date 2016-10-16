<?php

namespace Codeception\Lib\Connector;

use Symfony\Component\BrowserKit\Client;
use Symfony\Component\BrowserKit\Response;

class UniversalRunkit extends Client {

    use Shared\PhpSuperGlobalsConverter;

    protected $index;
    protected $envModifier;

    public function setIndex($index) {
        $this->index = $index;
    }

    public function setEnvModifier(callable $modifier) {
        $this->envModifier = $modifier;
    }

    public function doRequest($request) {
        $uri = str_replace('http://localhost', '', $request->getUri());
        $method = strtoupper($request->getMethod());
        $parameters = $request->getParameters();

        $sandbox = new \Runkit_Sandbox();
        $sandbox->_COOKIE = $request->getCookies();
        $sandbox->_FILES = $this->remapFiles($request->getFiles());
        $sandbox->eval('$_SERVER = unserialize(\'' . serialize(array_merge([
                    'REQUEST_METHOD' => $method,
                    'REQUEST_URI' => "$uri?" . $this->requestParametersToQueryString($parameters),
                    'PHP_SELF' => 'index.php',
                    'SERVER_NAME' => 'localhost',
                    'SCRIPT_NAME' => 'index.php'], $request->getServer())) . '\');');
        $sandbox->_REQUEST = $this->remapRequestParameters($parameters);

        if ($method == 'GET') {
            $sandbox->_GET = $sandbox->_REQUEST;
        } else {
            $sandbox->_POST = $sandbox->_REQUEST;
        }

        if ($this->envModifier instanceof \Closure) {
            call_user_func($this->envModifier, $sandbox);
        }

        ob_start();
        $sandbox->include($this->index);

        $content = ob_get_contents();
        ob_end_clean();

        $headers = [];
        $php_headers = $sandbox->headers_list();

        if ($php_headers !== false) {
            foreach ($php_headers as $value) {
                // Get the header name
                $parts = explode(':', $value);
                if (count($parts) > 1) {
                    $name = trim(array_shift($parts));
                    // Build the header hash map
                    $headers[$name] = trim(implode(':', $parts));
                }
            }
        }

        $headers['Content-type'] = isset($headers['Content-type']) ? $headers['Content-type'] : "text/html; charset=UTF-8";

        $response_code = $sandbox->http_response_code();
        if ($response_code === false) {
            // It wasn't set, so it's default
            $response_code = 200;
        }

        $response = new Response($content, $response_code, $headers);
        return $response;
    }

    private function requestParametersToQueryString($parameters) {
        return http_build_query($parameters, '', '$');
    }

}
