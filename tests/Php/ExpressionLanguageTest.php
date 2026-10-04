<?php

declare(strict_types=1);

namespace App\Tests\Php;

use App\Component\Php\ExpressionLanguageDecorator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
final class ExpressionLanguageTest extends TestCase
{
    private ExpressionLanguageDecorator $expressionLanguage;

    protected function setUp(): void
    {
        $this->expressionLanguage = new ExpressionLanguageDecorator(new ExpressionLanguage());
    }

    public function testEvaluation(): void
    {
        static::assertEquals(
            3,
            $this->expressionLanguage->evaluate('2 + 1'),
            'You must implement the expression language evaluate method',
        );
    }

    public function testCompile(): void
    {
        // The compiler wraps every binary operation in parentheses.
        static::assertSame(
            '(2 + 1)',
            $this->expressionLanguage->compile('2 + 1'),
            'You must implement the expression language compile method',
        );
    }

    public function testAnotherEvaluation(): void
    {
        $robot = new class {
            public function sayHello(): string
            {
                return 'hello';
            }
        };

        static::assertEquals(
            'hello',
            $this->expressionLanguage->evaluate('robot.sayHello()', ['robot' => $robot]),
            'You must implement the expression language evaluate method',
        );
    }
}
