<?php

declare(strict_types=1);

namespace App\Component\Filesystem;

/**
 * A Finder keeps every in() and filter it is given, so each search starts
 * from a new one: Symfony\Component\Finder\Finder::create().
 *
 * @see https://symfony.com/doc/7.4/components/finder.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class FinderDecorator
{
    /**
     * Names of the files directly inside a directory.
     *
     * @return list<string>
     */
    public function getFilesFromAPath(string $path): array
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }

    /**
     * Names of the directories directly inside a directory.
     *
     * @return list<string>
     */
    public function getDirectoriesFromPath(string $path): array
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }

    /**
     * Names of the files inside a directory that contain a text.
     *
     * @return list<string>
     */
    public function getFilesWithIncludedText(string $path, string $text): array
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }

    /**
     * Returns the content of a file.
     */
    public function showContentsFromAFile(string $filePath): string
    {
        // TODO
        throw new \LogicException('TODO: implement ' . __METHOD__ . '()');
    }
}
