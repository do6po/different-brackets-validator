<?php
/**
 * Created by PhpStorm.
 * User: box
 * Date: 01.10.18
 * Time: 12:14
 */

namespace Src;


use Src\BracketsTypes\BracketsAbstract;
use Src\Helpers\ArrayHelper;

class BracketsExpression
{
    /**
     * @var string
     */
    protected $expressionString;

    /**
     * @var BracketsAbstract[]
     */
    protected $expressionArray = [];

    /**
     * BracketsExpression constructor.
     * @param string $expression
     * @throws Exceptions\UnknownBracketsException
     */
    public function __construct(string $expression)
    {
        $this->expressionString = $this->bracketFilter(trim($expression));
        $this->init();
    }

    /**
     * @throws Exceptions\UnknownBracketsException
     */
    protected function init()
    {
        foreach ($this->splitExpressionToArray($this->expressionString) as $char) {
            $this->expressionArray[] = BracketsFactory::create($char);
        }
    }

    protected function bracketFilter(string $expression)
    {
        return preg_replace('/[^\(\)\{\}\[\]]/', '', $expression);
    }

    protected function splitExpressionToArray(string $expression): array
    {
        return str_split($expression);
    }

    public function getCharactersCount(): int
    {
        return count($this->expressionArray);
    }

    public function balanceBracketValidation(): bool
    {
        $openedBrackets = [];

        foreach ($this->expressionArray as $bracketObject) {
            if ($bracketObject->isOpened()) {
                $openedBrackets[] = $bracketObject;
                continue;
            } elseif (
                count($openedBrackets) > 0
                && $bracketObject->canCloseBy(ArrayHelper::getLastElementOfArray($openedBrackets))
            ) {
                array_pop($openedBrackets);
                continue;
            }

            return false;
        }
        return count($openedBrackets) > 0 ? false : true;
    }
}