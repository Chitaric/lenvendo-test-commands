<?php
namespace Chitaric\Lenvendo\ConsoleCommands\IO;

use Chitaric\Lenvendo\ConsoleCommands\Parsers\LenvendoParser;
use Chitaric\Lenvendo\ConsoleCommands\Parsers\ParserInterface;

abstract class Input implements InputInterface
{
    protected ParserInterface $parser;
    
    protected array $tokens = [];

    protected ?string $command;
    protected array $arguments  = [];
    protected array $parameters = [];

    public function __construct(ParserInterface $parser = null)
    {
        $this->parser = $parser ?? new LenvendoParser;
        $this->parse();
    }

    /**
     * Processes command line arguments.
     */
    protected function parse()
    {
        $tokens = $this->tokens;
        $this->command = array_shift($tokens);

        foreach ($tokens as $token) {
            $this->arguments  = array_merge($this->arguments,  $this->parser->getArguments($token));
            $this->parameters = array_merge($this->parameters, $this->parser->getParameters($token));
        }
    }

        /**
     * Get command name
     *
     * @return string|null
     */
    public function getCommandName()
    {
        return $this->command;
    }
    
    /**
     * Returns all input arguments.
     *
     * @return array<string>
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Returns all input parameters.
     *
     * @return array<string>
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Returns required parameter or null.
     *
     * @param string $key
     * 
     * @return string|null
     */
    public function getParameter(string $key)
    {
        return $this->parameters[$key] ?? null;
    }
}
