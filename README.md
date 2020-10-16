# folded/history

Translate terms for your web app.

[![Build Status](https://travis-ci.com/folded-php/translation.svg?branch=main)](https://travis-ci.com/folded-php/translation) [![Maintainability](https://api.codeclimate.com/v1/badges/3010c88a7ae56d0c7165/maintainability)](https://codeclimate.com/github/folded-php/translation/maintainability) [![TODOs](https://img.shields.io/endpoint?url=https://api.tickgit.com/badge?repo=github.com/folded-php/translation)](https://www.tickgit.com/browse?repo=github.com/folded-php/translation)

## Summary

- [About](#about)
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Examples](#examples)
- [Version support](#version-support)

## About

I created this package to have a standalone, easy way to use translation in my web app. This library is based on Laravel's translation engine.

Folded is a constellation of packages to help you setting up a web app easily, using ready to plug in packages.

- [folded/action](https://github.com/folded-php/action): A way to organize your controllers for your web app.
- [folded/config](https://github.com/folded-php/config): Configuration utilities for your PHP web app.
- [folded/crypt](https://github.com/folded-php/crypt): Encrypt and decrypt strings for your web app.
- [folded/exception](https://github.com/folded-php/exception): Various kind of exception to throw for your web app.
- [folded/file](https://github.com/folded-php/file): Manipulate files with functions for your web app.
- [folded/history](https://github.com/folded-php/history): Manipulate the browser history for your web app.
- [folded/http](https://github.com/folded-php/http): HTTP utilities for your web app.
- [folded/orm](https://github.com/folded-php/orm): An ORM for you web app.
- [folded/routing](https://github.com/folded-php/routing): Routing functions for your PHP web app.
- [folded/request](https://github.com/folded-php/request): Request utilities, including a request validator, for your PHP web app.
- [folded/session](https://github.com/folded-php/session): Session functions for your web app.
- [folded/view](https://github.com/folded-php/view): View utilities for your PHP web app.

## Features

- Can translate terms in the desired language
- Can set a default language to fallback on
- Can use json and key based translations in the same time
- Can use pluralized translations

## Requirements

- PHP version >= 7.4.0
- Composer installed

## Installation

- [1. Install the package](#1-install-the-package)
- [2. Prepare the folders](#2-prepare-the-folders)
- [3. Add the bootstrap code](#3-add-the-bootstrap-code)

### 1. Install the package

In your root folder, run this command:

```bash
composer required folded/translation
```

### 2. Prepare the folders

To work, you need to have a folder that contains your translation. This is the recommended organization:

```
.
└── lang/
    ├── en
    └── fr
```

Inside the lang folders, you can use any organization that fits your needs, from key based translations to json based translation.

When using key based translation, you will likely put any files containing the key and translated terms in their according folder depending the language. Here is an example.

```
.
└── lang/
    ├── en/
    │   └── messages.php
    └── fr/
        └── messages.php
```

For example, the `messages.php` file can contain this for the en folder:

```php
return [
  "home" => [
    "title" => "Welcome in the home page",
  ],
];
```

And this for the fr folder:

```php
return [
  "home" => [
    "title" => "Bienvenue sur la page d'accueil",
  ],
];
```

Howether, if you want, you can use json based translation. A good use case with JSON based translation files is when you need to use the translated term as the key. JSON based translations files must leave in the immediate folder `lang`, unless the previous key based method. Here is an example:

```
.
└── lang/
    ├── en/
    │   └── messages.php
    ├── fr/
    │   └── messages.php
    ├── en.json
    └── fr.json
```

And here is the content of `en.json` for example:

```json
{
  "Contact us for a custom tailored quotation": "Contact us for a custom tailored quotation"
}
```

And here is the content of `fr.json`:

```json
{
  "Contact us for a custom tailored quotation": "Contactez nous pour un devis sur-mesure"
}
```

### 3. Add the bootstrap code

As early as possible, configure the library:

```php
use function Folded\setDefaultTranslationLang;
use function Folded\setTranslationFolderPath;

setDefaultTranslationLang("en");
setTranslationFolderPath("path/to/folder");
```

## Examples

Keep in mind that, at any moment, you can refer to the [official Laravel translation documentation](https://laravel.com/docs/7.x/localization) if you have some doubt.

- [1. Get a translated term ](#1-get-a-translated-term-by-its-key)
- [2. Use placeholders in translated term](#2-use-placeholders-in-translated-term)
- [3. Get a translated pluralized term](#3-get-a-pluralized-translated-term)
- [4. Change the lang before getting a translated term](#4-change-the-lang-before-getting-a-translated-term)

### 1. Get a translated term by its key

In this example, we will get a translated term from a key based translation.

```php
use function Folded\getTranslation;

echo getTranslation("messages.home.title");
```

This implies you have this folder structure:

```
.
└── lang/
    ├── en/
    │   └── messages.php
    └── fr/
        └── messages.php
```

You can also get a translated term from the original term text itself. For this, we recommend using JSON based translation.

```php
use function Folded\getTranslation;

echo getTranslation("Contact us for a custom tailored quotation");
```

This implies you have this folder structure:

```
.
└── lang/
    ├── en.json
    └── fr.json
```

### 2. Use placeholders in translated term

In this example, we will put values in a translation that contains placeholders.

```php
use function Folded\getTranslation;

echo getTranslation("messages.home.welcome", ["name" => "John"]);
```

This implies you have a translation like following:

```php
// lang/en/messages.php
return [
  "home" => [
    "welcome" => "Welcome, :name",
  ],
];
```

### 3. Get a pluralized translated term

In this example, will get a pluralizable term translation.

```php
use function Folded\getVariableTranslation;

$numberOfPageViewed = 5000;

echo getVariableTranslation("messages.home.page-viewed", $numberOfPageViewed);
```

This implies you have the following folder structure:

```
.
└── lang/
    ├── en/
    │   └── messages.php
    └── fr/
        └── messages.php
```

And your `messages.php` file in the en folder contains:

```php
return [
  "home" => [
    "page-viewed" => "{0} No page viewed|[1] One page viewed|[2,*] :count page viewed",
  ]
];
```

For more information, browse the [Laravel pluralized translation documentation](https://laravel.com/docs/7.x/localization#pluralization).

### 4. Change the lang before getting a translated term

In this example, we will change the lang right before getting the translated term.

```php
use function Folded\setTranslationLang;
use function Folded\getTranslation;

setTranslationLang("fr");

echo getTranslation("messages.home.title");
```

## Version support

|        | 7.3 | 7.4 | 8.0 |
| ------ | --- | --- | --- |
| v0.1.0 | ❌  | ✔️  | ❓  |
