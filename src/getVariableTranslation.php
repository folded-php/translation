<?php

declare(strict_types = 1);

namespace Folded;

if (!function_exists("Folded\getVariableTranslation")) {
    /**
     * Get a variable translation, with countable variations.
     *
     * @param string               $path    The path or the translation key.
     * @param int                  $count   The number of actual items.
     * @param array<string,string> $replace An associative array to replace placeholders.
     *
     * @since 0.1.0
     *
     * @example
     * getVariableTranslation("messages.home.page-viewed", 5000);
     */
    function getVariableTranslation(string $path, int $count, array $replace = []): string
    {
        return Translator::getVariable($path, $count, $replace);
    }
}
