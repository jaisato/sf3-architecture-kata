<?php

declare(strict_types=1);

namespace App\Tests\Filesystem;

use App\Component\Filesystem\FilesystemDecorator;
use PHPUnit\Framework\TestCase;

/**
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
final class FilesystemTest extends TestCase
{
    private FilesystemDecorator $fileSystem;

    /** @var list<string> Paths created by a test, removed after it. */
    private array $created = [];

    protected function setUp(): void
    {
        $this->fileSystem = new FilesystemDecorator();
    }

    protected function tearDown(): void
    {
        foreach ($this->created as $path) {
            if (is_dir($path)) {
                @rmdir($path);
            } elseif (is_file($path)) {
                @unlink($path);
            }
        }
        $this->created = [];
    }

    public function testCreatingDirectories(): void
    {
        $directoryName = $this->created[] = sys_get_temp_dir() . '/' . uniqid('sf-kata-', true);

        $this->fileSystem->createDirectory($directoryName);

        self::assertDirectoryExists($directoryName, 'You must implement createDirectory method');
    }

    public function testCreatingFiles(): void
    {
        $file = $this->created[] = sys_get_temp_dir() . '/' . uniqid('sf-kata-', true) . '.txt';

        $this->fileSystem->createAnEmptyFile($file);

        self::assertFileExists($file, 'You must implement createAnEmptyFile method');
    }
}
