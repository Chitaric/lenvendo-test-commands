<?php
namespace Chitaric\Lenvendo\ConsoleCommands\IO;

class ArrayInput extends Input
{
    /**
     * Constructor
     *
     * @param array $command
     * @param array $arguments
     * @param array $parameters
     */
    public function __construct(string $command, array $arguments = [], array $parameters = [])
    {
        $this->command    = $command;
        $this->arguments  = $arguments;
        $this->parameters = $parameters;
    }
}
