<?php
/**
 * Created by PhpStorm.
 * User: Boiko Sergii
 * Date: 30.09.2018
 * Time: 2:34
 */

namespace tests\unit;

use PHPUnit\Framework\TestCase;
use Src\BracketsFactory;
use Src\BracketsTypes\Braces;
use Src\BracketsTypes\RoundBrackets;
use Src\BracketsTypes\SquareBrackets;

class BracketsFactoryTest extends TestCase
{
    /**
     * @param $bracketString
     * @param $expectedClass
     * @throws \Src\Exceptions\UnknownBracketsException
     * @dataProvider createDataProvider
     */
    public function testCreate($bracketString, $expectedClass)
    {
        $this->assertInstanceOf($expectedClass, BracketsFactory::create($bracketString));
    }

    public function createDataProvider()
    {
        return [
            ['(', RoundBrackets::class],
            [')', RoundBrackets::class],
            ['[', SquareBrackets::class],
            [']', SquareBrackets::class],
            ['{', Braces::class],
            ['}', Braces::class],
        ];
    }
}
