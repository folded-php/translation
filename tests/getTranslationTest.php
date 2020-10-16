<?php

declare(strict_types = 1);

use Folded\Translator;
use function Folded\getTranslation;
use function Folded\setTranslationFolderPath;
use function Folded\setDefaultTranslationLang;

beforeEach(fn () => Translator::clear());

it("should get the translation", function (): void {
    setTranslationFolderPath(__DIR__ . "/misc/lang");
    setDefaultTranslationLang("en");

    expect(getTranslation("messages.home.title"))->toBe("Home page");
});
