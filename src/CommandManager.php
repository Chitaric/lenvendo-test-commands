<?php
namespace Chitaric\Lenvendo\ConsoleCommands;

use Chitaric\Lenvendo\ConsoleCommands\IO\ArgvInput;
use Chitaric\Lenvendo\ConsoleCommands\IO\ArrayInput;
use Chitaric\Lenvendo\ConsoleCommands\IO\InputInterface;
use Chitaric\Lenvendo\ConsoleCommands\IO\OutputInterface;

/* Commands */
use Chitaric\Lenvendo\ConsoleCommands\Commands\CommandInterface;
use Chitaric\Lenvendo\ConsoleCommands\Commands\HelpCommand;
use Chitaric\Lenvendo\ConsoleCommands\Commands\ListCommand;
use Chitaric\Lenvendo\ConsoleCommands\Commands\NotFoundCommand;

class CommandManager
{
    protected static array $commands = [
        "help" => HelpCommand::class,
        "list" => ListCommand::class,
    ];
    protected const FALLBACK_COMMAND_CLASS = NotFoundCommand::class;

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
            static::$commands[$class::getName()] = $class;
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
     * @param string|null $name
     * 
     * @return array|null
     */
    public static function getCommandClass(?string $name)
    {
        return static::$commands[$name] ?: null;
    }

    /**
     * Find and execute console command by $input arguments
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    public static function execute(InputInterface $input = null, OutputInterface $output = null)
    {
        $input = $input ?? new ArgvInput();

        $command = $input->getCommandName() ?? "list";
        $class = static::getCommandClass($command) ?: static::FALLBACK_COMMAND_CLASS;

        if (in_array("help", $input->getArguments())) {
            $input = new ArrayInput("help", [$input->getCommandName()]);
            $class = static::$commands["help"];
        }
        
        /** @var CommandInterface */
        $command = new $class($input, $output);
        $command->execute();
    }
}
