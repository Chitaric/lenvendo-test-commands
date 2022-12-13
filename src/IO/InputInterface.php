<?php
namespace Chitaric\Lenvendo\ConsoleCommands\IO;

interface InputInterface
{
    /**
     * Get command name
     *
     * @return string|null
     */
    public function getCommandName();
    
    /**
     * Returns all input arguments.
     *
     * @return array<string>
     */
    public function getArguments();

    /**
     * Returns all input parameters.
     *
     * @return array<string>
     */
    public function getParameters();

    /**
     * Returns required parameter or null.
     *
     * @param string $key
     * 
     * @return string|null
     */
    public function getParameter(string $key);

}
