<?php
/**
 * Created by PhpStorm.
 * User: Boiko Sergii
 * Date: 30.09.2018
 * Time: 1:44
 */

namespace tests\unit\BracketsTypes;

use PHPUnit\Framework\TestCase;
use Src\BracketsFactory;
use Src\BracketsTypes\Braces;
use Src\BracketsTypes\BracketsAbstract;
use Src\BracketsTypes\RoundBrackets;
use Src\BracketsTypes\SquareBrackets;

class BracketsTest extends TestCase
{
    /**
     * @param $symbol
     * @param BracketsAbstract $class
     * @param $expected
     * @dataProvider compareDataProvider
     */
    public function testCompare($symbol, $class, $expected)
    {
        $this->assertEquals($expected, $class::compareType($symbol));
    }

    public function compareDataProvider()
    {
        return [
            ['(', RoundBrackets::class, true],
            [')', RoundBrackets::class, true],
            ['', RoundBrackets::class, false],
            ['[', SquareBrackets::class, true],
            [']', SquareBrackets::class, true],
            ['', SquareBrackets::class, false],
            ['{', Braces::class, true],
            ['}', Braces::class, true],
            ['', Braces::class, false],
        ];
    }

    /**
     * @param $bracket
     * @param $class
     * @param $expected
     * @dataProvider isOpenedDataProvider
     */
    public function testIsOpened($bracket, $class, $expected)
    {
        /**
         * @var BracketsAbstract $bracketModel
         */
        $bracketModel = new $class($bracket);
        $this->assertEquals($expected, $bracketModel->isOpened());
    }

    public function isOpenedDataProvider()
    {
        return [
            ['(', RoundBrackets::class, true],
            [')', RoundBrackets::class, false],
            ['[', SquareBrackets::class, true],
            [']', SquareBrackets::class, false],
            ['{', Braces::class, true],
            ['}', Braces::class, false],
        ];
    }

    /**
     * @param $firstBracket
     * @param $secondBracket
     * @param $expected
     * @throws \Src\Exceptions\UnknownBracketsException
     * @dataProvider canCloseByDataProvider
     */
    public function testCanCloseBy($firstBracket, $secondBracket, $expected)
    {
        $firstBracketObject = BracketsFactory::create($firstBracket);
        $secondBracketObject = BracketsFactory::create($secondBracket);

        $this->assertEquals($expected, $firstBracketObject->canCloseBy($secondBracketObject));
    }

    public function canCloseByDataProvider()
    {
        return [
            ['(', ')', true],
            ['[', ']', true],
            ['{', '}', true],
            ['(', '(', true],
            ['(', ']', false],
        ];
    }
}
