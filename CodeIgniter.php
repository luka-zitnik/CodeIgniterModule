<?php
namespace Codeception\Module;

use Codeception\Lib\Framework;
use Codeception\TestCase;
use Codeception\Lib\Connector\UniversalRunkit as UniversalRunkitConnector;

/**
 *
 */
class CodeIgniter extends Framework
{

  public function _initialize() {
  }

  public function _before(TestCase $test) {
    $this->client = new UniversalRunkitConnector();
    $this->client->setIndex(__DIR__ . '/../../../../../../public/index.php');
  }

}
