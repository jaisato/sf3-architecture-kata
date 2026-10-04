<?php

declare(strict_types=1);

namespace App\Component\Filesystem;

use Symfony\Component\Filesystem\Filesystem;

/**
 * @see https://symfony.com/doc/7.4/components/filesystem.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class FilesystemDecorator
{
    private readonly Filesystem $filesystem;

    public function __construct()
    {
        $this->filesystem = new Filesystem();
    }

    /**
     * Creates a system directory.
     */
    public function createDirectory(string $path): void
    {
        // TODO
    }

    /**
     * Creates a system file.
     */
    public function createAnEmptyFile(string $filePath): void
    {
        // TODO
    }
}
