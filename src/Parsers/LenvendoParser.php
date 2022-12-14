<?php
namespace Chitaric\Lenvendo\ConsoleCommands\Parsers;

class LenvendoParser implements ParserInterface
{
    /**
     * Returns parsed input arguments.
     *
     * @param string $input
     * 
     * @return array<string>
     */
    public function getArguments(string $input)
    {
        preg_match("/^{(.+)}$/", $input, $match);
        return $match[1] ? explode(",", $match[1]) : [];
    }

    /**
     * Returns parsed input parameters.
     *
     * @param string $input
     * 
     * @return array<string>
     */
    public function getParameters(string $input)
    {
        preg_match("/^\[([^=]+)=({.+}|[^{}]+)\]$/", $input, $match);
        return !empty($match) ? [
            $match[1] => $this->getArguments($match[2]) ?: [$match[2]],
        ] : [];
    }
}
