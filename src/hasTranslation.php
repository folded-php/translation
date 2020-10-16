<?php

declare(strict_types = 1);

namespace Folded;

if (!function_exists("Folded\hasTranslation")) {
    /**
     * Returns true if a translation key exist, else returns false.
     * This does not work for JSON based translation.
     *
     * @param string $path The translation key.
     * @param string $lang The lang to check for. Default to the default lang set.
     *
     * @since 0.1.0
     *
     * @example
     * if (hasTranslation("message.home.title")) {
     *  echo "has translation";
     * } else {
     *  echo "has not translation";
     * }
     */
    function hasTranslation(string $path, string $lang = ""): bool
    {
        return Translator::has($path, $lang);
    }
}
