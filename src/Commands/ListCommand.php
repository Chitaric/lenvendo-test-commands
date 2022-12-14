<?php
namespace Chitaric\Lenvendo\ConsoleCommands\Commands;

use Chitaric\Lenvendo\ConsoleCommands\CommandManager;

/**
 * Output all registered commands
 */
class ListCommand extends Command
{
    protected const NAME        = "list";
    protected const DESCRIPTION = "Output list of registered commands";

    /**
     * Execute command
     *
     * @return void
     */
    public function execute() {
        $commands = CommandManager::getCommandsList();

        foreach ($commands as $name => $class) {
            $this->output->write([
                "\"", $name, "\"\n",
                "    - ", ($class::getDescription()), "\n"
            ]);
        }
    }
}
