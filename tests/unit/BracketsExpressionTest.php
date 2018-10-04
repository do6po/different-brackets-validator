<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 01.10.18
 * Time: 12:16
 */

namespace tests\unit;

use PHPUnit\Framework\TestCase;
use Src\BracketsExpression;
use tests\helpers\PrivateMethodTrait;

class BracketsExpressionTest extends TestCase
{
    use PrivateMethodTrait;

    /**
     * @throws \Src\Exceptions\UnknownBracketsException
     */
    public function testGetAsArray()
    {
        $bracketsExpression = new BracketsExpression('(1+1)');

        $this->assertEquals(2, $bracketsExpression->getCharactersCount());
    }

    /**
     * @param $expression
     * @param $expected
     * @throws \ReflectionException
     * @throws \Src\Exceptions\UnknownBracketsException
     * @dataProvider bracketFilterDataProvider
     */
    public function testBracketFilter($expression, $expected)
    {
        $method = $this->makePublicMethod(BracketsExpression::class, 'bracketFilter');

        $bracketsExpression = new BracketsExpression($expression);

        $this->assertEquals($expected, $method->invoke($bracketsExpression, $expression));
    }

    public function bracketFilterDataProvider()
    {
        return [
            ['(a+b)', '()'],
            ['[a+b]', '[]'],
            ['{a+b}', '{}'],
            ['(a * (a+b))', '(())'],
            ['[a * [a+b]]', '[[]]'],
            ['[a * (a+b)]', '[()]'],
        ];
    }

    /**
     * @param $expression
     * @param $expected
     * @throws \ReflectionException
     * @dataProvider splitExpressionToArrayDataProvider
     */
    public function testSplitExpressionToArray($expression, $expected)
    {
        $method = $this->makePublicMethod(BracketsExpression::class, 'splitExpressionToArray');
        /** @var BracketsExpression $expressionMock */
        $expressionMock = $this->getMockBuilder(BracketsExpression::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertEquals($expected, $method->invoke($expressionMock, $expression));
    }

    public function splitExpressionToArrayDataProvider()
    {
        return [
            [
                '()', ['(', ')'],
            ],
            [
                '[()]', ['[', '(', ')', ']'],
            ],
        ];
    }

    /**
     * @param $expression
     * @param $expected
     * @throws \Src\Exceptions\UnknownBracketsException
     * @dataProvider balanceBracketValidationDataProvider
     */
    public function testBalanceBracketValidation($expression, $expected)
    {
        $expressionObject = new BracketsExpression($expression);

        $this->assertEquals($expected, $expressionObject->balanceBracketValidation());
    }

    public function balanceBracketValidationDataProvider()
    {
        return [
            ['(a+b)', true],
            ['[(a+b)]', true],
            ['[a * (a+b)]', true],
            ['[a * (a+b)]', true],
            ['[a * (a+b)', false],
            ['[a+b)', false],
            ['[a+b)]', false],
            [']', false],
            ['a+b]}', false],
        ];
    }
}
