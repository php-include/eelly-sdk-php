<?php

declare(strict_types=1);

/*
 * This file is part of eelly package.
 *
 * (c) eelly.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eelly;

class Psr4Autoloader
{
    /**
     * An associative array where the key is a namespace prefix and the value
     * is an array of base directories for classes in that namespace.
     *
     * @var array
     */
    protected $prefixes = [];

    /**
     * Register loader with SPL autoloader stack.
     */
    public function register(): void
    {
        spl_autoload_register([$this, 'loadClass']);
    }

    /**
     * Adds a base directory for a namespace prefix.
     *
     * @param string $prefix  the namespace prefix
     * @param string $baseDir a base directory for class files in the
     *                        namespace
     * @param bool   $prepend if true, prepend the base directory to the stack
     *                        instead of appending it; this causes it to be searched first rather
     *                        than last
     */
    public function addNamespace($prefix, $baseDir, $prepend = false): void
    {
        // normalize namespace prefix
        $prefix = trim($prefix, '\\').'\\';

        // normalize the base directory with a trailing separator
        $baseDir = rtrim(rtrim($baseDir, '/'), DIRECTORY_SEPARATOR).'/';

        // initialize the namespace prefix array
        if (isset($this->prefixes[$prefix]) === false) {
            $this->prefixes[$prefix] = [];
        }

        // retain the base directory for the namespace prefix
        if ($prepend) {
            array_unshift($this->prefixes[$prefix], $baseDir);
        } else {
            array_push($this->prefixes[$prefix], $baseDir);
        }
    }

    /**
     * Loads the class file for a given class name.
     *
     * @param string $class the fully-qualified class name
     *
     * @return mixed the mapped file name on success, or boolean false on
     *               failure
     */
    public function loadClass($class)
    {
        // the current namespace prefix
        $prefix = $class;

        // work backwards through the namespace names of the fully-qualified
        // class name to find a mapped file name
        while (false !== $pos = strrpos($prefix, '\\')) {
            // retain the trailing namespace separator in the prefix
            $prefix = substr($class, 0, $pos + 1);

            // the rest is the relative class name
            $relativeClass = substr($class, $pos + 1);

            // try to load a mapped file for the prefix and relative class
            $mappedFile = $this->loadMappedFile($prefix, $relativeClass);
            if ($mappedFile) {
                return $mappedFile;
            }

            // remove the trailing namespace separator for the next iteration
            // of strrpos()
            $prefix = rtrim($prefix, '\\');
        }

        // never found a mapped file
        return false;
    }

    /**
     * Load the mapped file for a namespace prefix and relative class.
     *
     * @param string $prefix        the namespace prefix
     * @param string $relativeClass the relative class name
     *
     * @return mixed boolean false if no mapped file can be loaded, or the
     *               name of the mapped file that was loaded
     */
    protected function loadMappedFile($prefix, $relativeClass)
    {
        // are there any base directories for this namespace prefix?
        if (isset($this->prefixes[$prefix]) === false) {
            return false;
        }

        // look through base directories for this namespace prefix
        foreach ($this->prefixes[$prefix] as $baseDir) {
            // replace the namespace prefix with the base directory,
            // replace namespace separators with directory separators
            // in the relative class name, append with .php
            $file = $baseDir
                .str_replace('\\', '/', $relativeClass)
                .'.php';

            // if the mapped file exists, require it
            if ($this->requireFile($file)) {
                // yes, we're done
                return $file;
            }
        }

        // never found it
        return false;
    }

    /**
     * If a file exists, require it from the file system.
     *
     * @param string $file the file to require
     *
     * @return bool true if the file exists, false if not
     */
    protected function requireFile($file)
    {
        if (is_file($file)) {
            require $file;

            return true;
        }

        return false;
    }
}
