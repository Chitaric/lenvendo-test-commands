<?php
namespace Chitaric\Lenvendo\ConsoleCommands\IO;

use Chitaric\Lenvendo\ConsoleCommands\Parsers\ParserInterface;

class ArgvInput extends Input
{
    /**
     * Constructor
     *
     * @param array|null        $argv   Input arguments
     * @param ParserInterface   $parser Used parser to prepare inputs
     */    
    public function __construct(?array $argv = null, ParserInterface $parser = null)
    {
        $this->tokens = $argv ?? $_SERVER['argv'] ?? [];
        array_shift($this->tokens);

        parent::__construct($parser);
    }
}
