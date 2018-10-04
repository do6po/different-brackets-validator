<?php
/**
 * Created by PhpStorm.
 * User: Boiko Sergii
 * Date: 29.09.2018
 * Time: 17:24
 */

namespace Src;

use Src\BracketsTypes\Braces;
use Src\BracketsTypes\BracketsAbstract;
use Src\BracketsTypes\RoundBrackets;
use Src\BracketsTypes\SquareBrackets;
use Src\Exceptions\UnknownBracketsException;

class BracketsFactory
{
    /**
     * @param string $bracketString
     * @return \Src\BracketsTypes\BracketsAbstract
     * @throws \Src\Exceptions\UnknownBracketsException
     */
    public static function create(string $bracketString): BracketsAbstract
    {
        foreach (static::bracketClasses() as $class)
        if ($class::compareType($bracketString)) {
            return new $class($bracketString);
        }

        throw new UnknownBracketsException('Not authorized bracket: ' . $bracketString);
    }

    protected static function bracketClasses(): array
    {
        return [
            RoundBrackets::class,
            SquareBrackets::class,
            Braces::class,
        ];
    }
}