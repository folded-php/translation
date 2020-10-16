<?php

declare(strict_types = 1);

namespace Folded;

if (!function_exists("Folded\setTranslationFolderPath")) {
    /**
     * Set the folder path that contains translations files.
     *
     * @param string $path The path to the folder.
     *
     * @since 0.1.0
     *
     * @example
     * setTranslationFolderPath("path/to/folder");
     */
    function setTranslationFolderPath(string $path): void
    {
        Translator::setFolderPath($path);
    }
}
