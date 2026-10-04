<?php

declare(strict_types=1);

namespace App\Tests\Filesystem;

use App\Component\Filesystem\FinderDecorator;
use PHPUnit\Framework\TestCase;

/**
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
final class FinderTest extends TestCase
{
    private FinderDecorator $finder;

    protected function setUp(): void
    {
        $this->finder = new FinderDecorator();
    }

    public function testGettingFilesFromPath(): void
    {
        self::assertSame(
            ['aFile.txt'],
            $this->finder->getFilesFromAPath(__DIR__ . '/files'),
            'You must implement getFilesFromAPath method',
        );
    }

    public function testGettingDirectoriesFromPath(): void
    {
        self::assertSame(
            ['text'],
            $this->finder->getDirectoriesFromPath(__DIR__ . '/files'),
            'You must implement getDirectoriesFromPath method',
        );
    }

    public function testSearchOfAText(): void
    {
        self::assertSame(
            ['something.txt'],
            $this->finder->getFilesWithIncludedText(__DIR__ . '/files/text', 'hello'),
            'You must implement getFilesWithIncludedText method',
        );
    }

    public function testGettingContentFromFile(): void
    {
        $file = __DIR__ . '/files/aFile.txt';

        self::assertStringEqualsFile(
            $file,
            $this->finder->showContentsFromAFile($file),
            'You must implement showContentsFromAFile method',
        );
    }
}
