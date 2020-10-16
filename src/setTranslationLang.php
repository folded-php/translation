<?php

declare(strict_types = 1);

namespace Folded;

if (!function_exists("Folded\setTranslationLang")) {
    /**
     * Set the lang to use for the next translation retreival.
     *
     * @param string $lang The lang to use.
     *
     * @since 0.1.0
     *
     * @example
     * setTranslationLang("fr");
     */
    function setTranslationLang(string $lang): void
    {
        Translator::setLang($lang);
    }
}
