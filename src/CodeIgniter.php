<?php

namespace Codeception\Module;

use Codeception\Lib\Framework;
use Codeception\TestCase;
use Codeception\Lib\Connector\UniversalRunkit as UniversalRunkitConnector;

class CodeIgniter extends Framework {

    protected $config = [
        'index' => 'public/index.php'
    ];

    protected $ci_directory = [
        'root' => __DIR__.'/../../../../',
    ];

    public function _before(TestCase $test) {
        // prepare CI
        $this->prepare_ci();

        $index = \Codeception\Configuration::projectDir() . $this->config['index'];
        $this->client = new UniversalRunkitConnector();
        $this->client->setIndex($index);
        $this->client->setEnvModifier(function ($sandbox) use ($index) {
            $sandbox->eval('function is_cli() { return false; }');
            $sandbox->chdir(dirname($index));
        });
    }

    public function _after(TestCase $test){
        $this->rollback_ci();
    }

    protected function prepare_ci(){
        // get index file
        $index_content = $this->get_index_content();

        // get system path
        $system_path = $this->get_system_path($index_content);

        // prepare url helper
        $this->prepare_url_helper($system_path);
    }

    protected function rollback_ci(){
        // get index file
        $index_content = $this->get_index_content();

        // get system path
        $system_path = $this->get_system_path($index_content);

        // rollback url helper
        $this->prepare_url_helper($system_path, TRUE);
    }

    protected function get_index_content(){
        $index_path = $this->ci_directory['root'].$this->config['index'];

        (file_exists($index_path)) OR die($this->error($this->config['index'].' Not Found!'));

        $index_content = file_get_contents($index_path);

        return $index_content;
    }


    protected function get_system_path($index_content){
        // find system_path variable
        $result = '';
        preg_match('/^.*\bsystem_path\b.*$/m', $index_content, $result);
        (isset($result[0])) OR die($this->error('Can not found system_path in index.php!'));

        // eval system_path
        eval(trim($result[0]));
        (isset($system_path)) OR die($this->error('Can not set $system_path in index.php!'));

        // set system path
        $system_path = $this->ci_directory['root'].$system_path;
        (is_writable($system_path)) OR die($this->error('$system_path is not writeable'));

        return $system_path;
    }

    protected function prepare_url_helper($system_path, $rollback = FALSE){
        $url_helper_path = $system_path . '/helpers/url_helper.php';

        // replace
        $url_helper_text = file_get_contents($url_helper_path);

        // find commented exit
        $exit_commented = strpos($url_helper_text, '//exit;');

        // roll back uri helper
        if ($rollback) {
            if($exit_commented){
                $url_helper_text = str_replace('//exit;', 'exit;', $url_helper_text);
            }
        }
        // set uri helper
        else{
            if(! $exit_commented){
                $url_helper_text = str_replace('exit;', '//exit;', $url_helper_text);
            }
        }

        $status = file_put_contents($url_helper_path, $url_helper_text);
    }

    protected function error($msg){
        return "\n\033[31m". "CodeIgniter Module: ". $msg. "\033[0m". PHP_EOL;
    }
}
