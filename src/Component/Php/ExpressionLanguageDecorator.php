<?php

declare(strict_types=1);

namespace App\Component\Php;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * @see https://symfony.com/doc/7.4/components/expression_language.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class ExpressionLanguageDecorator
{
    public function __construct(private readonly ExpressionLanguage $expressionLanguage) {}

    /**
     * The expression is evaluated without being compiled to PHP.
     *
     * @param array<string, mixed> $values
     */
    public function evaluate(string $expression, array $values = []): mixed
    {
        return $this->expressionLanguage->evaluate($expression, $values);
    }

    /**
     * The expression is compiled to PHP, so it can be cached and evaluated.
     *
     * @param list<string> $names
     */
    public function compile(string $expression, array $names = []): string
    {
        return $this->expressionLanguage->compile($expression, $names);
    }
}
