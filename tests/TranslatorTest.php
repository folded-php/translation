<?php

declare(strict_types = 1);

use Folded\Exceptions\FolderNotFoundException;
use Folded\Exceptions\NotAFolderException;
use Folded\Translator;

beforeEach(fn () => Translator::clear());

it("should get the translated term", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");

    expect(Translator::get("messages.home.title"))->toBe("Home page");
});

it("should get the translated term in a specific language", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");
    Translator::setLang("fr");

    expect(Translator::get("messages.home.title"))->toBe("Page d'accueil");
});

it("should get the translation term with variables", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");

    expect(Translator::get("messages.home.welcome", ["name" => "John"]))->toBe("Welcome, John");
});

it("should get the translation term with variables in a specific language", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");
    Translator::setLang("fr");

    expect(Translator::get("messages.home.welcome", ["name" => "John"]))->toBe("Bienvenue, John");
});

it("should get the count variable term with 0", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");

    expect(Translator::getVariable("messages.home.page-viewed", 0))->toBe("This page has never been viewed");
});

it("should get the count variable term with 1", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");

    expect(Translator::getVariable("messages.home.page-viewed", 1))->toBe("This page has been viewed 1 time");
});

it("should get the count variable term with many", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");

    expect(Translator::getVariable("messages.home.page-viewed", 2))->toBe("This page has been viewed 2 times");
});

it("should get the count variable term with 0 in a specific language", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");
    Translator::setLang("fr");

    expect(Translator::getVariable("messages.home.page-viewed", 0))->toBe("Cette page n'a jamais été vue");
});

it("should get the count variable term with 1 in a specific language", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");
    Translator::setLang("fr");

    expect(Translator::getVariable("messages.home.page-viewed", 1))->toBe("Cette page a été vue 1 fois");
});

it("should get the count variable term with many in a specific language", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");
    Translator::setLang("fr");

    expect(Translator::getVariable("messages.home.page-viewed", 2))->toBe("Cette page a été vue 2 fois");
});

it("should get the translated term from json", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");

    expect(Translator::get("A sentence from JSON"))->toBe("A sentence from JSON");
});

it("should get the translated term from json in a specific language", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");
    Translator::setLang("fr");

    expect(Translator::get("A sentence from JSON"))->toBe("Une phrase depuis JSON");
});

it("should get the translated term with variable from json", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");

    expect(Translator::get("Find your way, :name", ["name" => "John"]))->toBe("Find your way, John");
});

it("should get the translated term with variable from json in a specific language", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");
    Translator::setLang("fr");

    expect(Translator::get("Find your way, :name", ["name" => "John"]))->toBe("Trouve ta voie, John");
});

it("should get the variable translation from json with 0", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");

    expect(Translator::getVariable("Discover these :count new posts", 0))->toBe("Stay tuned for future posts");
});

it("should get the variable translation from json with 1", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");

    expect(Translator::getVariable("Discover these :count new posts", 1))->toBe("Discover this new post");
});

it("should get the variable translation from json with many", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");

    expect(Translator::getVariable("Discover these :count new posts", 2))->toBe("Discover these 2 new posts");
});

it("should get the variable translation from json with 0 in a specific language", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");
    Translator::setLang("fr");

    expect(Translator::getVariable("Discover these :count new posts", 0))->toBe("Restez à l'affut des prochains articles");
});

it("should get the variable translation from json with 1 in a specific language", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");
    Translator::setLang("fr");

    expect(Translator::getVariable("Discover these :count new posts", 1))->toBe("Découvrez ce nouvel article");
});

it("should get the variable translation from json with many in a specific language", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");
    Translator::setLang("fr");

    expect(Translator::getVariable("Discover these :count new posts", 2))->toBe("Découvrez ces 2 nouveaux articles");
});

it("should return true if the key exist", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");

    expect(Translator::has("messages.home.title"))->toBeTrue();
});

it("should return true if the key exist for a specific lang", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");

    expect(Translator::has("messages.home.title", "fr"))->toBeTrue();
});

it("should return false if the key does not exist", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");

    expect(Translator::has("messages.home.footer"))->toBeFalse();
});

it("should return false if the key does not exist for a specific language", function (): void {
    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::setDefaultLang("en");

    expect(Translator::has("messages.home.introduction", "fr"))->toBeFalse();
});

it("should throw an exception if the folder path does not exist", function (): void {
    $folder = __DIR__ . "/misc/not-found";

    $this->expectException(FolderNotFoundException::class);
    $this->expectExceptionMessage("folder $folder not found");

    Translator::setFolderPath($folder);
});

it("should set the folder path in the exception if the folder path does not exist", function (): void {
    $folder = __DIR__ . "/misc/not-found";

    try {
        Translator::setFolderPath($folder);
    } catch (FolderNotFoundException $exception) {
        expect($exception->getFolder())->toBe($folder);
    }
});

it("should throw an exception if the folder path is not a folder", function (): void {
    $folder = __DIR__ . "/misc/lang/en.json";

    $this->expectException(NotAFolderException::class);
    $this->expectExceptionMessage("$folder is not a folder");

    Translator::setFolderPath($folder);
});

it("should set the folder in the exception if the folder path is not a folder", function (): void {
    $folder = __DIR__ . "/misc/lang/en.json";

    try {
        Translator::setFolderPath($folder);
    } catch (NotAFolderException $exception) {
        expect($exception->getFolder())->toBe($folder);
    }
});

it("should throw an exception if the default lang has not been set", function (): void {
    $this->expectException(Exception::class);
    $this->expectExceptionMessage("lang must be filled");

    Translator::setFolderPath(__DIR__ . "/misc/lang");
    Translator::get("messages.home.title");
});

it("should throw an exception if the folder path has not been set", function (): void {
    $this->expectException(Exception::class);
    $this->expectExceptionMessage("folder path must be filled");

    Translator::get("messages.home.title");
});
