<?php

declare(strict_types = 1);

namespace Folded;

use Exception;
use Folded\Exceptions\NotAFolderException;
use Folded\Exceptions\FolderNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator as LaravelTranslator;

/**
 * Converts keys into tranlations.
 *
 * @since 0.1.0
 */
final class Translator
{
    /**
     * @since 0.1.0
     */
    const DEFAULT_DEFAULT_LANG = "";

    /**
     * @since 0.1.0
     */
    const DEFAULT_ENGINE = null;

    /**
     * @since 0.1.0
     */
    const DEFAULT_FOLDER_PATH = "";

    /**
     * The default lang to use for translated terms.
     *
     * @since 0.1.0
     */
    private static string $defaultLang = self::DEFAULT_DEFAULT_LANG;

    /**
     * The engine that will work with translation.
     *
     * @since 0.1.0
     */
    private static ?LaravelTranslator $engine = self::DEFAULT_ENGINE;

    /**
     * The folder path that holds translations files.
     *
     * @since 0.1.0
     */
    private static string $folderPath = self::DEFAULT_FOLDER_PATH;

    /**
     * Clears the state of the object.
     * Useful for unit testing.
     *
     * @since 0.1.0
     *
     * @example
     * Translator::clear();
     */
    public static function clear(): void
    {
        self::$defaultLang = self::DEFAULT_DEFAULT_LANG;
        self::$engine = self::DEFAULT_ENGINE;
        self::$folderPath = self::DEFAULT_FOLDER_PATH;
    }

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
     * echo Translator::get("messages.home.title");
     */
    public static function get(string $path, array $replace = []): string
    {
        $translation = self::engine()->get($path, $replace);

        if (is_array($translation)) {
            throw new Exception("path $path returns an array");
        }

        return $translation;
    }

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
     * Translator::getVariable("messages.home.page-viewed", 5000);
     */
    public static function getVariable(string $path, int $count, array $replace = []): string
    {
        return self::engine()->choice($path, $count, $replace);
    }

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
     * if (Translator::has("message.home.title")) {
     *  echo "has translation";
     * } else {
     *  echo "has not translation";
     * }
     */
    public static function has(string $path, string $lang = ""): bool
    {
        $choosenLang = empty(trim($lang)) ? self::$defaultLang : $lang;

        return self::engine()->has($path, $choosenLang);
    }

    /**
     * Set the default lang.
     *
     * @param string $lang The default lang.
     *
     * @since 0.1.0
     *
     * @example
     * Translator::setDefaultLang("en");
     */
    public static function setDefaultLang(string $lang): void
    {
        self::$defaultLang = $lang;
    }

    /**
     * Set the folder path that contains translations files.
     *
     * @param string $path The path to the folder.
     *
     * @since 0.1.0
     *
     * @example
     * Translator::setFolderPath("path/to/folder");
     */
    public static function setFolderPath(string $path): void
    {
        if (!file_exists($path)) {
            throw (new FolderNotFoundException("folder $path not found"))->setFolder($path);
        }

        if (!is_dir($path)) {
            throw (new NotAFolderException("$path is not a folder"))->setFolder($path);
        }

        self::$folderPath = $path;
    }

    /**
     * Set the lang to use for the next translation retreival.
     *
     * @param string $lang The lang to use.
     *
     * @since 0.1.0
     *
     * @example
     * Translator::setLang("fr");
     */
    public static function setLang(string $lang): void
    {
        self::engine()->setLocale($lang);
    }

    /**
     * Throws an exception if the default lang has not been set.
     *
     * @throws Exception If the default lang has not been set.
     *
     * @since 0.1.0
     *
     * @example
     * Translator::checkDefaultLangFilled();
     */
    private static function checkDefaultLangFilled(): void
    {
        if (empty(trim(self::$defaultLang))) {
            throw new Exception("lang must be filled");
        }
    }

    /**
     * Throws an exception if the folder path has not been set.
     *
     * @throws Exception If the folder path has not been set.
     *
     * @since 0.1.0
     *
     * @example
     * Translator::checkFolderPathFilled();
     */
    private static function checkFolderPathFilled(): void
    {
        if (empty(trim(self::$folderPath))) {
            throw new Exception("folder path must be filled");
        }
    }

    /**
     * Returns the translation engine if it has not been set, else return the previously instanciated (acting as a singleton).
     *
     * @since 0.1.0
     *
     * @example
     * $engine = Translator::engine();
     */
    private static function engine(): LaravelTranslator
    {
        self::checkFolderPathFilled();
        self::checkDefaultLangFilled();

        if (!(self::$engine instanceof LaravelTranslator)) {
            self::$engine = new LaravelTranslator(new FileLoader(new Filesystem(), self::$folderPath), self::$defaultLang);

            self::$engine->setFallback(self::$defaultLang);
            self::$engine->setLocale(self::$defaultLang);
        }

        return self::$engine;
    }
}
