<?php
/**
 * Created by PhpStorm.
 * User: Boiko Sergii
 * Date: 29.09.2018
 * Time: 14:38
 */
namespace Src;

class BracketsValidator
{
    /**
     * @param string $expression
     * @return bool
     * @throws Exceptions\UnknownBracketsException
     */
    public static function validate(string $expression): bool
    {
        $expressionObject = new BracketsExpression($expression);
        return $expressionObject->balanceBracketValidation();
    }
}