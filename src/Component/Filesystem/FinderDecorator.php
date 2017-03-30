<?php
declare(strict_types=1);

namespace Component\Filesystem;

use Symfony\Component\Finder\Finder;

/**
 * @link http://symfony.com/doc/current/components/finder.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Component\Filesystem
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class FinderDecorator
{
    private $finder;

    public function __construct()
    {
        $this->finder = new Finder();
    }

    /**
     * @param string $path
     * @return array
     */
    public function getFilesFromAPath(string $path)
    {
        // TODO
    }

    /**
     * @param string $path
     * @return array
     */
    public function getDirectoriesFromPath(string $path)
    {
        // TODO
    }

    /**
     * @param string $path
     * @param string $text
     *
     * @return array
     */
    public function getFilesWithIncludedText(string $path, string $text)
    {
        // TODO
    }
}
