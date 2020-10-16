<?php

declare(strict_types = 1);

namespace Folded;

use Exception;

if (!function_exists("Folded\getTranslation")) {
    /**
     * Get a translation form a key.
     *
     * @param string               $path    The path or the translation key.
     * @param array<string,string> $replace An associative array to replace placeholders.
     *
     * @throws Exception If the path returns an array instead of a string.
     *
     * @since 0.1.0
     *
     * @example
     * echo getTranslation("messages.home.title");
     */
    function getTranslation(string $path, array $replace = []): string
    {
        return Translator::get($path, $replace);
    }
}
