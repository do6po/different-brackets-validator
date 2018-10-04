<?php
/**
 * Created by PhpStorm.
 * User: Boiko Sergii
 * Date: 29.09.2018
 * Time: 21:19
 */

namespace Src\BracketsTypes;

abstract class BracketsAbstract
{
    const BRACKET_OPENED_SYMBOL = '';

    const BRACKET_CLOSED_SYMBOL = '';

    protected $bracket;

    public function __construct(string $bracket)
    {
        $this->bracket = $bracket;
    }

    public static function compareType(string $symbol): bool
    {
        if (static::BRACKET_OPENED_SYMBOL === $symbol) {
            return true;
        } elseif (static::BRACKET_CLOSED_SYMBOL === $symbol) {
            return true;
        }

        return false;
    }

    public function canCloseBy(self $bracketObject): bool
    {
        return $this->isOpened() && static::BRACKET_CLOSED_SYMBOL === $bracketObject::BRACKET_CLOSED_SYMBOL;
    }

    public function isOpened(): bool
    {
        return static::BRACKET_OPENED_SYMBOL === $this->bracket;
    }
}