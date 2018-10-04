<?php
/**
 * Created by PhpStorm.
 * User: Boiko Sergii
 * Date: 29.09.2018
 * Time: 15:34
 */

namespace tests\unit;

use PHPUnit\Framework\TestCase;
use Src\BracketsValidator;

class BracketsValidatorTest extends TestCase
{
    /**
     * @param $expression
     * @param $expected
     * @throws \Src\Exceptions\UnknownBracketsException
     * @dataProvider validateDataProvider
     */
    public function testValidate($expression, $expected)
    {
        $this->assertEquals($expected, BracketsValidator::validate($expression));
    }

    public function validateDataProvider()
    {
        return [
            ['()', true],
            ['(()', false],
            ['((', false],
            ['[]', true],
            ['{}', true],
            ['[', false],
            ['(', false],
            [')', false],
        ];
    }
}
