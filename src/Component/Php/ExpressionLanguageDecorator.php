<?php
declare(strict_types=1);

namespace Component\Php;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * @link http://symfony.com/doc/current/components/expression_language.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Component\Php
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class ExpressionLanguageDecorator
{
    /** @var ExpressionLanguage */
    private $expressionLanguage;

    public function __construct(ExpressionLanguage $expressionLanguage)
    {
        $this->expressionLanguage = $expressionLanguage;
    }

    /**
     * the expression is evaluated without being compiled to Php
     *
     * @param string $expression
     * @param array $values
     * @return mixed
     */
    public function evaluate(string $expression, array $values = [])
    {
        // TODO
    }

    /**
     * the expression is compiled to Php, so it can be cached and evaluated
     *
     * @param string $expression
     * @param array $names
     * @return mixed
     */
    public function compile(string $expression, array $names = [])
    {
        // TODO
    }
}
