<?php
namespace Chitaric\Lenvendo\ConsoleCommands\Parsers;

interface ParserInterface
{
    /**
     * Returns parsed input arguments.
     *
     * @param string $input
     * 
     * @return array<string>
     */
    public function getArguments(string $input);

    /**
     * Returns parsed input parameters.
     *
     * @param string $input
     * 
     * @return array<string>
     */
    public function getParameters(string $input);
}
