<?php

declare(strict_types = 1);

use Folded\Translator;
use function Folded\getVariableTranslation;
use function Folded\setTranslationFolderPath;
use function Folded\setDefaultTranslationLang;

beforeEach(fn () => Translator::clear());

it("should get the variable translation", function (): void {
    setTranslationFolderPath(__DIR__ . "/misc/lang");
    setDefaultTranslationLang("en");

    expect(getVariableTranslation("Discover these :count new posts", 0))->toBe("Stay tuned for future posts");
});
