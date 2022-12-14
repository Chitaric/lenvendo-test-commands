<?php
namespace Chitaric\Lenvendo\ConsoleCommands\Commands;

use Chitaric\Lenvendo\ConsoleCommands\CommandManager;
use Chitaric\Lenvendo\ConsoleCommands\IO\InputInterface;

/**
 * Output commands info (description)
 */
class HelpCommand extends Command
{
    protected const NAME        = "help";
    protected const DESCRIPTION = "Output help info about command";

    /**
     * Execute command
     *
     * @return void
     */
    public function execute() {
        $command = $this->input->getArguments()[0] ?? null;
        if (empty($command)) {
            $command = "help";
            $class   = static::class;
        } else {
            $class = CommandManager::getCommandClass($command);
        }
        
        $this->output->write([
            "Command: \"", $command, "\"\n",
            " - ", ($class::getDescription()), "\n"
        ]);
    }
}