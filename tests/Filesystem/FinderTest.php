<?php
declare(strict_types=1);

namespace Tests\Filesystem;

use Component\Filesystem\FinderDecorator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Tests\Filesystem
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class FinderTest extends KernelTestCase
{
    /** @var  FinderDecorator */
    private $finder;

    protected function setUp()
    {
        $this->finder = new FinderDecorator();
    }

    public function testGettingFilesFromPath()
    {
        self::assertEquals(
            ['aFile.txt'],
            $this->finder->getFilesFromAPath(__DIR__ . '/files'),
            'You must to implement getFilesFromAPath method'
        );
    }

    public function testGettingDirectoriesFromPath()
    {
        self::assertEquals(
            ['text'],
            $this->finder->getDirectoriesFromPath(__DIR__ . '/files'),
            'You must to implement getDirectoriesFromPath method'
        );
    }

    public function testSearchOfAText()
    {
        self::assertEquals(
            ['something.txt'],
            $this->finder->getFilesWithIncludedText(__DIR__ . '/files/text', 'hello'),
            'You must to implement getFilesWithIncludedText method'
        );
    }

    public function testGettingContentFromFile()
    {
        $file = __DIR__ . '/files/aFile.txt';

        $content = $this->finder->showContentsFromAFile($file);

        self::assertStringEqualsFile(
            $file, $content, 'you must to implement showContentsFromAFile method'
        );
    }
}
