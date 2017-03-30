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

    public function setUp()
    {
        $this->fileSystem = new FilesystemDecorator();
    }

    public function testCreatingDirectories()
    {
        $directoryName = '/tmp/' . mt_rand();

        $this->fileSystem->createDirectory($directoryName);

        self::assertDirectoryExists($directoryName, 'You must to implement createDirectory method');
    }

    public function testCreatingFiles()
    {
        $file = '/tmp/' . mt_rand() . 'txt';

        $this->fileSystem->createAnEmptyFile($file);

        self::assertFileExists($file, 'You must to implement createAnEmptyFile method');
    }

    public function testGettingContentFromFile()
    {
        $file = __DIR__ . '/files/aFile.txt';

        $content = $this->fileSystem->showContentsFromAFile($file);

        self::assertStringEqualsFile(
            $file, $content, 'you must to implement showContentsFromAFile method'
        );
    }
}
