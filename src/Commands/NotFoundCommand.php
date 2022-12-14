<?php
namespace Chitaric\Lenvendo\ConsoleCommands\Commands;

/**
 * Fallback command to missing commands
 */
class NotFoundCommand extends Command
{
    protected const NAME        = "fallback";
    protected const DESCRIPTION = "Output fallback message";

    /**
     * Execute command
     *
     * @return void
     */
    public function execute() {
        $this->output->write([
            "Command \"", $this->input->getCommandName(), "\" not found!\n"
        ]);
    }
}