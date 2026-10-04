<?php

declare(strict_types=1);

namespace App\Component\Filesystem;

use Symfony\Component\Finder\Finder;

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
        return $this->names(Finder::create()->files()->in($path)->depth(0));
    }

    /**
     * Names of the directories directly inside a directory.
     *
     * @return list<string>
     */
    public function getDirectoriesFromPath(string $path): array
    {
        return $this->names(Finder::create()->directories()->in($path)->depth(0));
    }

    /**
     * Names of the files inside a directory that contain a text.
     *
     * @return list<string>
     */
    public function getFilesWithIncludedText(string $path, string $text): array
    {
        return $this->names(Finder::create()->files()->in($path)->contains($text));
    }

    /**
     * Returns the content of a file.
     */
    public function showContentsFromAFile(string $filePath): string
    {
        $files = Finder::create()->files()->in(\dirname($filePath))->depth(0)->name(basename($filePath));

        foreach ($files as $file) {
            return $file->getContents();
        }

        throw new \RuntimeException(\sprintf('File "%s" not found.', $filePath));
    }

    /**
     * @return list<string>
     */
    private function names(Finder $finder): array
    {
        $names = [];

        foreach ($finder->sortByName() as $file) {
            $names[] = $file->getFilename();
        }

        return $names;
    }
}
