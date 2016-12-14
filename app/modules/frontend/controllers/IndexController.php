<?php

namespace PhalconStart\Modules\Frontend\Controllers;

use Phalcon\Cli\CliDispatcher;
use PhalconStart\Models\TestTable;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $dispatcher = new CliDispatcher();
        var_dump($dispatcher);
    }

}

