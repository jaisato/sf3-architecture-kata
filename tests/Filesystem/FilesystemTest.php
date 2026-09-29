<?php
declare(strict_types=1);

namespace Tests\Filesystem;

use Component\Filesystem\FilesystemDecorator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Tests\Filesystem
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class FilesystemTest extends KernelTestCase
{
    /** @var  FilesystemDecorator */
    private $fileSystem;

    /** @var string[] Paths created by a test, removed after it. */
    private $created = [];

    public function setUp(): void
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

    public function testCreatingDirectories()
    {
        $directoryName = $this->created[] = sys_get_temp_dir() . '/' . uniqid('sf-kata-', true);

        $this->fileSystem->createDirectory($directoryName);

        self::assertDirectoryExists($directoryName, 'You must to implement createDirectory method');
    }

    public function testCreatingFiles()
    {
        $file = $this->created[] = sys_get_temp_dir() . '/' . uniqid('sf-kata-', true) . '.txt';

        $this->fileSystem->createAnEmptyFile($file);

        self::assertFileExists($file, 'You must to implement createAnEmptyFile method');
    }
}
