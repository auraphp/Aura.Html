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

### Escaping

All helpers escape values internally.

TBD: Escaping Functions


### Helpers

Use a helper by calling it as a method on the _HelperLocator_.

#### anchor

```php
<?php
echo $helper->anchor('http://auraphp.com', 'Aura Project');
// <a href="http://auraphp.com">Aura Project</a>
?>
```


#### base

```php
<?php
echo $helper->base('/base')
// <base href="/base" />
?>
```

#### img

```php
<?php
echo $helper->img('hello.jpg', array('alt' => 'Hello', 'width' => 100, 'height' => 200));
// <img src="hello.jpg" alt="Hello" width="100" height="200">
?>
```

#### links 

```php
<?php
$helper->links()->add(array(
    'rel' => 'prev',
    'href' => '/path/to/prev',
));

$helper->links()->add(array(
    'rel' => 'next',
    'href' => '/path/to/next',
));

echo $helper->links();
?>
```

Alternatively you can do by chaining

```php
<?php
echo $helper->links()
    ->add(array(
        'rel' => 'prev',
        'href' => '/path/to/prev',
    ))
    ->add(array(
        'rel' => 'next',
        'href' => '/path/to/next',
    ));
?>
```

#### metas 

```php
<?php
echo $helper->metas()
    ->addHttp('Location', '/redirect/to/here');
    ->addName('foo', 'bar');

// <meta http-equiv="Location" content="/redirect/to/here">
// <meta name="foo" content="bar">
?>
```

#### ol

```php
<?php
$ol = $helper->ol(array('id' => 'test'));
$ol->items(array('foo', 'bar', 'baz'))
   ->item('dib', array('class' => 'callout'));
/*
<ol id="test">
    <li>foo</li>
    <li>bar</li>
    <li>baz</li>
    <li class="callout">dib</li>
</ol>
*/
?>
```

#### ul

```php
<?php
echo $helper->ul(array('id' => 'test'])
    ->items(array('foo', 'bar', 'baz'))
    ->item('dib', array('class' => 'callout'));
/*
<ul id="test">
    <li>foo</li>
    <li>bar</li>
    <li>baz</li>
    <li class="callout">dib</li>
</ul>
*/
?>

#### scripts

```php
<?php
echo $helper->scripts()
    ->add('/js/first.js')
    ->add('/js/middle.js')
    ->add('/js/last.js');

/*
<script src="/js/first.js" type="text/javascript"></script>
<script src="/js/middle.js" type="text/javascript"></script>
<script src="/js/last.js" type="text/javascript"></script>
*/
?>
```

You can also set order by which the scripts need to be taken, 
conditional scripts etc as below.

```php
<?php
echo $helper->scripts()
    ->add('/js/last.js', array(), 150)
    ->add('/js/first.js', array(), 50)
    ->add('/js/middle.js')
    ->addCond('ie6', '/js/ie6.js');
/*
<script src="/js/first.js" type="text/javascript"></script>
<script src="/js/middle.js" type="text/javascript"></script>
<!--[if ie6]><script src="/js/ie6.js" type="text/javascript"></script><![endif]-->
<script src="/js/last.js" type="text/javascript"></script>
*/
?>
```

There is also `scriptsFoot()`, which works the same, but is intended for placing scripts at the end of the HTML body.


#### styles

```php
<?php
$helper->styles()->add('/css/middle.css', array('media' => 'print'));
$helper->styles()->add('/css/last.css', null, 150);
$helper->styles()->add('/css/first.css', null, 50);
$helper->styles()->addCond('ie6', '/css/ie6.css', array('media' => 'print'));
echo $helper->styles();
/*
<link rel="stylesheet" href="/css/first.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/css/middle.css" type="text/css" media="print" />
<!--[if ie6]><link rel="stylesheet" href="/css/ie6.css" type="text/css" media="print" /><![endif]-->
<link rel="stylesheet" href="/css/last.css" type="text/css" media="screen" />
*/
?>
```

#### tag

A generic tag helper.

```php
<?php
echo $helper->tag('div', array(
    'id' => 'foo',
));
// <div id="foo">
?>
```

#### title

```php
<?php
$helper->title()->set('This and That');

$helper->title()->append(' Suf1');
$helper->title()->append(' Suf2');

$helper->title()->prepend('Pre1');
$helper->title()->prepend('Pre2');
        
echo $helper->title();

// <title>Pre2Pre1This and That Suf1 Suf2</title>
?>
``` 


