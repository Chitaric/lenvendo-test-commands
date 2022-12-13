<?php
namespace Chitaric\Lenvendo\ConsoleCommands\IO;

class EchoOutput implements OutputInterface
{
    /**
     * Writes a message to the output.
     *
     * @param string|iterable $messages The message as an iterable of strings or a single string
     */
    public function write($messages) {
        foreach ((array)$messages as $message) {
            echo $message;
        }
    }
}
