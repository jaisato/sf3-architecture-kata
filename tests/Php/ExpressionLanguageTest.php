<?php
declare(strict_types=1);

namespace Tests\Php;

use Component\Php\ExpressionLanguageDecorator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Tests\Php
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class ExpressionLanguageTest extends KernelTestCase
{
    /** @var ExpressionLanguageDecorator */
    private $expressionLanguage;

    public function setUp()
    {
        $this->expressionLanguage = new ExpressionLanguageDecorator(new ExpressionLanguage());
    }

    public function testEvaluation()
    {
        static::assertEquals(
            3,
            $this->expressionLanguage->evaluate('2 + 1'),
            'You must to implement the expression language evaluate method'
        );
    }

    public function testCompile()
    {
        static::assertEquals(
            '2 + 1',
            $this->expressionLanguage->compile('2 + 1'),
            'You must to implement the expression language evaluate method'
        );
    }

    public function testAnotherEvaluation()
    {
        $robot = new class {
            public function sayHello()
            {
                return 'hello';
            }
        };

        static::assertEquals(
            'hello',
            $this->expressionLanguage->evaluate('robot.sayHello', ['robot' => $robot]),
            'You must to implement the expression language evaluate method'
        );
    }
}
