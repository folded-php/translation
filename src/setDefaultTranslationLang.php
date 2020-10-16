<?php

declare(strict_types = 1);

namespace Folded;

if (!function_exists("Folded\setDefaultTranslationLang")) {
    /**
     * Set the default lang.
     *
     * @param string $lang The default lang.
     *
     * @since 0.1.0
     *
     * @example
     * setDefaultTranslationLang("en");
     */
    function setDefaultTranslationLang(string $lang): void
    {
        Translator::setDefaultLang($lang);
    }
}
