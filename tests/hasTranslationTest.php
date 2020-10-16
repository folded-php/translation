<?php

declare(strict_types = 1);

use Folded\Translator;
use function Folded\hasTranslation;
use function Folded\setTranslationFolderPath;
use function Folded\setDefaultTranslationLang;

beforeEach(fn () => Translator::clear());

it("should return true if the translation key exist", function (): void {
    setTranslationFolderPath(__DIR__ . "/misc/lang");
    setDefaultTranslationLang("en");

    expect(hasTranslation("messages.home.title"))->toBeTrue();
});
