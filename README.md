# Aura.Html

Provides independent HTML view helpers, including form input helpers, that can be used in any template, view, or presentation system.

## Foreword

### Installation

This library requires PHP 5.4 or later, and has no userland dependencies.

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

You can then use the helpers by calling them as methods on the _HelperLocator_ instance.  See the [tag helpers](https://github.com/auraphp/Aura.Html/blob/functions/README-HELPERS.md) and [form helpers](https://github.com/auraphp/Aura.Html/blob/functions/README-HELPERs.md) pages for more information.

### Escaping

(N.b.: All helpers escape values appropriately; see the _Escaper_ class internals for more information.)

One of the tasks with PHP-based template systems is to escape output properly. Invoking escaper functionality is often verbose makes the template code look cluttered.  This package comes with four namespaced escaper functions to reduce the verbosity and clutter:  `a()`, `c()`, `j()`, and `h(). These escape values for HTML attributes, CSS, JavaScript, and HTML values, respectively.

To call the namespaced escaper functions in a PHP-based template, `use` the EscaperFunctions_ namespace, then call the functions as you would any other function.

Here are contrived examples of `h()` and `a()` in use:

```php
<?php use Aura\Html\EscaperFunctions; ?>

<h1><?= h($blog->title) ?></h1>

<p class="byline">by <?= h($blog->author) ?> on <?= h($blog->date) ?></p>

<div id="<?php a($blog->div_id) ?>">
    <?= $blog->raw_html ?>
</div>
```

Here are contrived examples of `c()` and `j()` in use:

```php
<?php use Aura\Html\EscaperFunctions; ?>
<style>
body: {
    color: <?= c($theme->color) ?>;
    font-size: <?= c($theme->font_size) ?>;
}
</style>

<script language="javascript">
    var foo = "<?= j($js->foo); ?>";
</script>

