<?php

declare(strict_types = 1);

use Folded\Translator;
use function Folded\setDefaultTranslationLang;
use function Folded\setTranslationFolderPath;
use function Folded\setTranslationLang;

beforeEach(fn () => Translator::clear());

it("should return null", function (): void {
    setTranslationFolderPath(__DIR__ . "/misc/lang");
    setDefaultTranslationLang("en");
    expect(setTranslationLang("en"))->toBeNull();
});
