<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use damianbal\QuizAPI\Core\Router;

final class RouterTest extends TestCase
{
    public function test_checkIfPartsAreTheSame()
    {
        $router = new Router();

        $should_be_ok = $router->checkIfPartsAreTheSame(['index', 'xd'], ['index', 'xd']);
        $should_fail = $router->checkIfPartsAreTheSame(['music', 'xd'], ['bla', 'ha']);
        $should_pass = $router->checkIfPartsAreTheSame(['music', '2'], ['music', '@id']);

        $this->assertEquals($should_be_ok, true);
        $this->assertEquals($should_fail, false);
        $this->assertEquals($should_pass, true);
    }
}