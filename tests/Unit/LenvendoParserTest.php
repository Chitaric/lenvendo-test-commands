<?php
namespace Chitaric\Lenvendo\ConsoleCommands\Tests\Unit\Parsers;

use Chitaric\Lenvendo\ConsoleCommands\IO\ArgvInput;
use Chitaric\Lenvendo\ConsoleCommands\Parsers\LenvendoParser as ParsersLenvendoParser;
use PHPUnit\Framework\TestCase;

class LenvendoParser extends TestCase
{

    /**
     * Data provider to testTokenParse test
     *
     * @return array
     */
    public function providerTokenParse()
    {
        return [
            ["{arg1}", ["arg1"], []],
            ["{arg1,arg2}", ["arg1", "arg2"], []],
            ["{arg1,arg2,arg3}", ["arg1", "arg2", "arg3"], []],
            ["[some={arg1}]", [], ["some" => ["arg1"]]],
            ["[any={arg1,arg2}]", [], ["any" => ["arg1", "arg2"]]],
            ["[other={arg1,arg2,arg3}]", [], ["other" => ["arg1", "arg2", "arg3"]]],
        ];
    }

    /**
     * Test correct parsing string
     *
     * @dataProvider providerTokenParse
     * @param string $token
     * @param array $arguments
     * @param array $parameters
     * 
     * @return void
     */
    public function testTokenParse(string $token, array $arguments, array $parameters)
    {
        $parser = new ParsersLenvendoParser();

        $this->assertEquals($arguments, $parser->getArguments($token));
        $this->assertEqualsCanonicalizing ($parameters, $parser->getParameters($token));
    }

    /**
     * Data provider to testTokenParse test
     *
     * @return array
     */
    public function providerInputParseResult()
    {
        return [
            [["{arg1}"], ["arg1"], []],
            [["{arg1,arg2,arg3}"], ["arg1", "arg2", "arg3"], []],
            [["{arg1}", "{arg2,arg3}"], ["arg1", "arg2", "arg3"], []],
            [["arg1"], [], []],
            [["[some={arg1}]"], [], ["some" => ["arg1"]]],
            [["[other={arg1,arg2,arg3}]"], [], ["other" => ["arg1", "arg2", "arg3"]]],
            [["evil", "{arg2,arg3}", "{arg1}"], ["arg2", "arg3", "arg1"], []],
            [["[another={good}]", "[evil={beautiful}]", "{arg2,arg3}", "[evil={bad}]"], ["arg2", "arg3"], ["evil" => ["bad"], "another" => ["good"]]],
            [["[arg=evil]", "{arg2,arg3}", "[arg={neutral,good}]"], ["arg2", "arg3"], ["arg" => ["neutral", "good"]]],
        ];
    }

    /**
     * Test correct parsing result aggregate
     *
     * @dataProvider providerInputParseResult
     * @param array $tokens
     * @param array $arguments
     * @param array $parameters
     * 
     * @return void
     */
    public function testInputParseResult(array $tokens, array $arguments, array $parameters)
    {
        $parser = new ParsersLenvendoParser();
        $input = new ArgvInput(array_merge(["app command", "exec command"], $tokens), $parser);

        $this->assertEquals($arguments, $input->getArguments());
        $this->assertEqualsCanonicalizing ($parameters, $input->getParameters());
    }
}