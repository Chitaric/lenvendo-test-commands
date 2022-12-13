<?php
namespace Chitaric\Lenvendo\ConsoleCommands\Commands;

use Chitaric\Lenvendo\ConsoleCommands\IO\InputInterface;
use Chitaric\Lenvendo\ConsoleCommands\IO\OutputInterface;

interface CommandInterface
{
    /**
     * Constructor
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    public function __construct(InputInterface $input, OutputInterface $output);

    /**
     * Get command descriptions
     *
     * @return string
     */
    public static function getDescription();

    /**
     * Get command name (to registrations and so on)
     *
     * @return string
     */
    public static function getName();

    /**
     * Execute command
     *
     * @return void
     */
    public function execute();
}
