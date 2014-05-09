# Aura.Html

Provides independent HTML view helpers, including form input helpers, that can be used in any template, view, or presentation system.

## Foreword

### Installation

This library requires PHP 5.3 or later, and has no userland dependencies.

It is installable and autoloadable via Composer as [aura/html](https://packagist.org/packages/aura/html).

Alternatively, [download a release](https://github.com/auraphp/Aura.Html/releases) or clone this repository, then require or include its _autoload.php_ file.

### Quality

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/auraphp/Aura.Html/badges/quality-score.png?s=7341b8a60405c1fb59deeca9635df0c22dca641e)](https://scrutinizer-ci.com/g/auraphp/Aura.Html/)
[![Code Coverage](https://scrutinizer-ci.com/g/auraphp/Aura.Html/badges/coverage.png?s=5c77a6d485b19a62edcd6da96ee9ed484c753cd0)](https://scrutinizer-ci.com/g/auraphp/Aura.Html/)
[![Build Status](https://travis-ci.org/auraphp/Aura.Html.png?branch=develop-2)](https://travis-ci.org/auraphp/Aura.Html)

To run the [PHPUnit][] tests at the command line, go to the _tests_ directory and issue `phpunit`.

This library attempts to comply with [PSR-1][], [PSR-2][], and [PSR-4][]. If
you notice compliance oversights, please send a patch via pull request.

[PHPUnit]: http://phpunit.de/manual/
[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md

### Community

To ask questions, provide feedback, or otherwise communicate with the Aura community, please join our [Google Group](http://groups.google.com/group/auraphp), follow [@auraphp on Twitter](http://twitter.com/auraphp), or chat with us on #auraphp on Freenode.


## Getting Started

The easiest way to instantiate a _HelperLocator_ with all the available helpers is to use the _HelperLocatorFactory_:

```php
<?php
$factory = new \Aura\Html\HelperLocatorFactory;
$helper = $factory->newInstance();
?>
```

### Built-In Helpers

Once you have a _HelperLocator_, you can then use the helpers by calling them as methods on the _HelperLocator_ instance.  See the [tag helpers](https://github.com/auraphp/Aura.Html/blob/functions/README-HELPERS.md) and [form helpers](https://github.com/auraphp/Aura.Html/blob/functions/README-HELPERs.md) pages for more information.

> N.b.: All helpers escape values appropriately; see the various helper class internals for more information.

### Custom Helpers

There are two steps to adding your own custom helpers:

1. Write a helper class

2. Set a factory for that class into the _HelperLocator_ under a service name

A helper class needs only to implement the `__invoke()` method.  We suggest extending from _AbstractHelper_ to get access to indenting, escaping, etc., but it's not required.

The following example helper class applies ROT-13 to a string.

```php
<?php
namespace Vendor\Package;

class Obfuscate
{
    public function __invoke($string)
    {
        return str_rot13($input);
    }
}
?>
```

Now that we have a helper class, we set a factory for it into the _HelperLocator_ under a service name. Therein, we create **and return** the helper class.

```php
<?php
$helper->set('obfuscate', function () {
    return new \Vendor\Package\Obfuscate;
});
?>
```
    
The service name in the _HelperLocator_ doubles as a method name. This means we can call the helper via `$this->obfuscate()`:

```php
<?= $helper->obfuscate('plain text') ?>
```

Note that we can use any service name for the helper, although it is generally
useful to name the service for the helper class, and for a word that can be called as a method.

Please examine the classes in `Aura\Html\Helper` for more complex and powerful
examples.

### Escaping

One of the tasks with PHP-based template systems is to escape output properly. Invoking escaper functionality is often verbose makes the template code look cluttered.  The _Escaper_ comes with four static methods to reduce the verbosity and clutter:  `a()`, `c()`, `j()`, and `h(). These escape values for HTML attributes, CSS, JavaScript, and HTML values, respectively.

> N.b.: In Aura, we generally avoid static methods. However, the tradeoff of less-cluttered templates is worth it in this one case.

To call the static _Escaper_ methods in a PHP-based template, `use` the _Escaper_ as a short alias name, then call the static methods on the alias.  (If you did not instantiate a _HelperLocatorFactory_, you will need to prepare the static escaper methods by calling `Escaper::setStatic(new Escaper)`.)

Here is a contrived example of the various static methods:

```html+php
<?php use Aura\Html\Escaper as e; ?>

<head>
    <style>
        body: {
            color: <?= e::c($theme->color) ?>;
            font-size: <?= e::c($theme->font_size) ?>;
        }
    </style>
    <script language="javascript">
        var foo = "<?= e::j($js->foo); ?>";
    </script>
</head>

<body>
    <h1><?= e::h($blog->title) ?></h1>

    <p class="byline">
        by <?= e::h($blog->author) ?>
        on <?= e::h($blog->date) ?>
    </p>

    <div id="<?php e::a($blog->div_id) ?>">
        <?= $blog->raw_html ?>
    </div>
</body>
```
