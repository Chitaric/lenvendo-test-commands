<?php
namespace Chitaric\Lenvendo\ConsoleCommands;

use Chitaric\Lenvendo\ConsoleCommands\Commands\CommandInterface;

class CommandManager
{
    protected static array $commands = [

    ];
    protected const DEFAULT_COMMAND = "";

    /**
     * Register new command
     *
     * @param string $class Class that instanceof \Chitaric\Lenvendo\ConsoleCommands\Commands\CommandInterface::class
     * 
     * @return void
     */
    public static function registerCommand(string $class)
    {
        if (class_exists($class) && is_a($class, CommandInterface::class, true)) {
            static::$commands[$class::NAME] = $class;
        }
    }

    /**
     * Getter to registered commands
     *
     * @return array
     */
    public static function getCommandsList()
    {
        return static::$commands;
    }

    /**
     * Get command class by command name (or default command)
     *
     * @param string $name
     * 
     * @return array
     */
    public static function getCommandClass(string $name)
    {
        return static::$commands[$name] ?: static::DEFAULT_COMMAND;
    }
}
