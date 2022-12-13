<?php
namespace Chitaric\Lenvendo\ConsoleCommands\Commands;

use Chitaric\Lenvendo\ConsoleCommands\IO\ArgvInput;
use Chitaric\Lenvendo\ConsoleCommands\IO\EchoOutput;
use Chitaric\Lenvendo\ConsoleCommands\IO\InputInterface;
use Chitaric\Lenvendo\ConsoleCommands\IO\OutputInterface;

abstract class Command implements CommandInterface
{
    protected InputInterface  $input;
    protected OutputInterface $output;

    protected const NAME        = "";
    protected const DESCRIPTION = "";

    /**
     * Constructor
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    public function __construct(InputInterface $input = null, OutputInterface $output = null)
    {
        $this->input  = $input  ?? new ArgvInput();
        $this->output = $output ?? new EchoOutput();
    }

    /**
     * Get command descriptions
     *
     * @return string
     */
    public static function getDescription()
    {
        return static::DESCRIPTION;
    }

    /**
     * Get command name (to registrations and so on)
     *
     * @return string
     */
    public static function getName()
    {
        return static::NAME ?: static::class;
    }
}
