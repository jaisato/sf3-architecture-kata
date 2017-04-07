<?php
declare(strict_types=1);

namespace Component\Filesystem;

use Symfony\Component\Filesystem\Filesystem;

/**
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Component\Filesystem
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class FilesystemDecorator
{
    /** @var Filesystem */
    private $filesystem;

    public function __construct()
    {
        $this->filesystem = new Filesystem();
    }

    /**
     * Creates a system directory.
     *
     * @param string $path
     */
    public function createDirectory(string $path)
    {
        // TODO
    }

    /**
     * Creates a system file.
     *
     * @param string $filePath
     */
    public function createAnEmptyFile(string $filePath)
    {
        // TODO
    }
}
