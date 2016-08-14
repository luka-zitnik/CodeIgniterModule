<?php

namespace Codeception\Module;

use Codeception\Lib\Framework;
use Codeception\TestCase;
use Codeception\Lib\Connector\UniversalRunkit as UniversalRunkitConnector;

class CodeIgniter extends Framework {

    protected $config = [
        'index' => 'public/index.php'
    ];

    public function _before(TestCase $test) {
        $index = \Codeception\Configuration::projectDir() . $this->config['index'];
        $this->client = new UniversalRunkitConnector();
        $this->client->setIndex($index);
        $this->client->setEnvModifier(function ($sandbox) use ($index) {
            $sandbox->eval('function is_cli() { return false; }');
            $sandbox->chdir(dirname($index));
        });
    }

}
