<?php


namespace Commands;

use Phalcon\Script\Color;
use Phalcon\Commands\Command;

/**
 * Info Command
 *
 * @package Phalcon\Commands\Builtin
 */
class MyCommand extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams()
    {
        return [
            'help' => 'Shows this help [optional]',
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @param array $parameters
     * @return mixed
     */
    public function run(array $parameters)
    {
        print '  ' . Color::colorize('Ready to write your own command', Color::FG_GREEN) . PHP_EOL;
        return 0;
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands()
    {
        return ['my-command', 'my'];
    }

    /**
     * {@inheritdoc}
     *
     * @return boolean
     */
    public function canBeExternal()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function getHelp()
    {
        print Color::head('Help:') . PHP_EOL;
        print Color::colorize('  MyCommand just for test') . PHP_EOL . PHP_EOL;
    }

    /**
     * {@inheritdoc}
     *
     * @return integer
     */
    public function getRequiredParams()
    {
        return 0;
    }
}
