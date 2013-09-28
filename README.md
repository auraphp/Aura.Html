# Aura.Html

Provides HTML view helpers, including form input helpers.

## Foreword

### Installation and Autoloading

This library is installable and autoloadable via Composer with the following
`require` element in your `composer.json` file:

    "require": {
        "aura/html": "dev-develop-2"
    }
    
Alternatively, download or clone this repository, then require or include its
_autoload.php_ file.

### Dependencies and PHP Version

As with all Aura libraries, this library has no userland dependencies. It
requires PHP version 5.4 or later.

### Tests

[![Build Status](https://travis-ci.org/auraphp/Aura.{PACKAGE}.png?branch=develop-2)](https://travis-ci.org/auraphp/Aura.{PACKAGE})

This library has 100% code coverage with [PHPUnit][]. To run the tests at the
command line, go to the _tests_ directory and issue `phpunit`.

[phpunit]: http://phpunit.de/manual/

### PSR Compliance

This library attempts to comply with [PSR-1][], [PSR-2][], and [PSR-4][]. If
you notice compliance oversights, please send a patch via pull request.

[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md


## Getting Started

The easiest way to instantiate with all the available helpers is to 
include the `instance.php` script:

```php
<?php
$helper = require "/path/to/Aura.Html/scripts/instance.php";
?>
```

### Form Helpers

Form : `$helper->form(array $attr = []);`

Example

```php
<?php
$helper->form();
// <form method="post" enctype="multipart/form-data">
$helper->form(['action' => '/hello-action', 'method' => 'GET']);
// <form method="GET" action="/hello-action" enctype="multipart/form-data">
?>
```

Form Input
----------

Creating `HTML5` input types is easy. Some of the built in form 
input types are `button`, `checkbox`, `color`, `date`, `datetime`, 
`datetime-local`, `email`, `file`, `hidden`, `image`, `month`, 
`number`, `password`, `range`, `reset`, `search`, `submit`, `tel`, 
`text`, `time`, `url`, `week`.

Replace the `$type` with the corresponding type.

```php
<?php
$helper->input([
    'type' => $type,
    'name' => $name,
    'value' => $value,
    'attribs' => [],
    'options' => [],
]);
?>
```

checkbox

```php
<?php
$helper->input([
    'type' => "checkbox",
    'name' => "name",
    'value' => "value",
    'attribs' => [
        'value' => "value",
        'value_checked' => true,
    ],
    'options' => [],
]);

// <input type="checkbox" name="foo">

$helper->input([
    'value' => 'yes',
    'attribs' => [
        'value' => 'yes',
        'value_unchecked' => 'no',
        'label' => 'This is yes',
    ],
]);

// <label><input type="hidden" value="no" /><input type="checkbox" value="yes" checked /> This is yes</label>;

$helper->input([
    'type' => "checkbox",
    'value' => 'no',
    'attribs' => [
        'value' => 'yes',
        'label' => 'This is yes',
    ]
]);

// <label><input type="checkbox" value="yes" /> This is yes</label>
?>
```

radio : 

```php
<?php        
$options = [
    'foo' => 'bar',
    'baz' => 'dib',
    'zim' => 'gir',
];

$helper->input([
    'type' => 'radio',
    'name' => 'field',
    'value' => 'baz',
    'attribs' => [],
    'options' => $options,
]);

// <label><input type="radio" name="field" value="foo" /> bar</label>
// <label><input type="radio" name="field" value="baz" checked /> dib</label>
// <label><input type="radio" name="field" value="zim" /> gir</label>
?>
```

select :

```php
<?php
$helper->input([
    'type' => 'select',
    'name' => 'foo[bar]',
    'value' => 'value5',
    'attribs' => [
        'placeholder' => 'Please pick one',
    ],
    'options' => [
        'value1' => 'First Label',
        'value2' => 'Second Label',
        'value5' => 'Fifth Label',
        'value3' => 'Third Label',
    ],
]);

/*
<select name="foo[bar]">
    <option disabled="" value="">Please pick one</option>
    <option value="value1">First Label</option>
    <option value="value2">Second Label</option>
    <option value="value5" selected="">Fifth Label</option>
    <option value="value3">Third Label</option>
</select>
*/
?>
```

textarea :

```php
<?php
$helper->input([
    'type' => 'textarea',
    'name' => 'field',
    'value' => "the quick brown fox",
]);
// <textarea name="field">the quick brown fox</textarea>
?>
```

button

```php
<?php
$helper->input([
    'type' => "button",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="button" name="name" value="value" />
?>
```

color

```php
<?php
$helper->input([
    'type' => "color",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="color" name="name" value="value" />
?>
```

date

```php
<?php
$helper->input([
    'type' => "date",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="date" name="name" value="value" />
?>
```

datetime

```php
<?php
$helper->input([
    'type' => "datetime",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="datetime" name="name" value="value" />
?>
```

datetime-local

```php
<?php
$helper->input([
    'type' => "datetime-local",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="datetime-local" name="name" value="value" />
?>
```

email

```php
<?php
$helper->input([
    'type' => "email",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="email" name="name" value="value" />
?>
```

file

```php
<?php
$helper->input([
    'type' => "file",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="file" name="name" value="value" />
?>
```

hidden

```php
<?php
$helper->input([
    'type' => "hidden",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="hidden" name="name" value="value" />
?>
```

image

```php
<?php
$helper->input([
    'type' => "image",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="image" name="name" value="value" />
?>
```

month

```php
<?php
$helper->input([
    'type' => "month",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="month" name="name" value="value" />
?>
```

number

```php
<?php
$helper->input([
    'type' => "number",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="number" name="name" value="value" />
?>
```

password

```php
<?php
$helper->input([
    'type' => "password",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="password" name="name" value="value" />
?>
```

range

```php
<?php
$helper->input([
    'type' => "range",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="range" name="name" value="value" />
?>
```

reset

```php
<?php
$helper->input([
    'type' => "reset",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="reset" name="name" value="value" />
?>
```

search

```php
<?php
$helper->input([
    'type' => "search",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="search" name="name" value="value" />
?>
```

submit

```php
<?php
$helper->input([
    'type' => "submit",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="submit" name="name" value="value" />
?>
```

tel

```php
<?php
$helper->irnput([
    'type' => "tel",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="tel" name="name" value="value" />
?>
```

text

```php
<?php
$helper->input([
    'type' => "text",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="text" name="name" value="value" />
?>
```

time

```php
<?php
$helper->input([
    'type' => "time",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="time" name="name" value="value" />
?>
```

url

```php
<?php
$helper->input([
    'type' => "url",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="url" name="name" value="value" />
?>
```

week

```php
<?php
$helper->input([
    'type' => "week",
    'name' => "name",
    'value' => "value",
    'attribs' => [],
    'options' => [],
]);

// <input type="week" name="name" value="value" />
?>
```

Anchor : `$helper->anchor($href, $text, array $attr = []);`

```php
<?php
$helper->anchor('http://auraphp.com', 'Aura Project');
// <a href="http://auraphp.com">Aura Project</a>
?>
```

Attribs : `$helper->attr();`

```php
<?php
// Missing ?
?>
``` 

Base : `$helper->base($href);`

```php
<?php
$helper->base('/base')
// <base href="/base" />
?>
```

Image : `$helper->img($src, array $attr = []);`

```php
<?php
$helper->img('hello.jpg', ['alt' => 'Hello', 'width' => 100, 'height' => 200]);
// <img src="hello.jpg" alt="Hello" width="100" height="200">
?>
```

Links : 

```php
<?php
$links = $helper->links();
$links->add([
    'rel' => 'prev',
    'href' => '/path/to/prev',
]);

$links->add([
    'rel' => 'next',
    'href' => '/path/to/next',
]);

$links->get();
?>
```

Alternatively you can do by chaining

```php
<?php
$helper->links()
->add([
    'rel' => 'prev',
    'href' => '/path/to/prev',
])
->add([
    'rel' => 'next',
    'href' => '/path/to/next',
])
->get();
?>
```

Metas : 

```php
<?php
$metas = $helper->metas();
$metas->addHttp('Location', '/redirect/to/here');
$metas->addName('foo', 'bar');

$metas->get();

// <meta http-equiv="Location" content="/redirect/to/here">
// <meta name="foo" content="bar">
?>
```

Ordered list (ol) :

```php
<?php
$ol = $helper->ol(['id' => 'test']);
$ol->items(['foo', 'bar', 'baz'])
    ->item('dib', ['class' => 'callout'])
    ->get();
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

Un-ordered list (ul) :

```php
<?php
$helper->ul(['id' => 'test'])
    ->items(['foo', 'bar', 'baz'])
    ->item('dib', ['class' => 'callout'])
    ->get();
/*
<ul id="test">
    <li>foo</li>
    <li>bar</li>
    <li>baz</li>
    <li class="callout">dib</li>
</ul>
*/
?>

scripts :

```php
<?php
$scripts = $helper->scripts();
$scripts->add('/js/first.js');
$scripts->add('/js/middle.js');
$scripts->add('/js/last.js');

$scripts->get();
/*
script src="/js/first.js" type="text/javascript"></script>
<script src="/js/middle.js" type="text/javascript"></script>
<script src="/js/last.js" type="text/javascript"></script>
*/
?>
```

You can also set order by which the scripts need to be taken, 
conditional scripts etc as below.

```php
<?php
$scripts = $helper->scripts();
$scripts->add('/js/last.js', [], 150);
$scripts->add('/js/first.js', [], 50);
$scripts->add('/js/middle.js');
$scripts->addCond('ie6', '/js/ie6.js');
/*
<script src="/js/first.js" type="text/javascript"></script>
<script src="/js/middle.js" type="text/javascript"></script>
<!--[if ie6]><script src="/js/ie6.js" type="text/javascript"></script><![endif]-->
<script src="/js/last.js" type="text/javascript"></script>
*/
?>
```

scriptsFoot :

```php
<?php
// tbd
?>
```

Styles :

```php
<?php
$styles = $helper->styles();
$styles->add('/css/middle.css', ['media' => 'print']);
$styles->add('/css/last.css', null, 150);
$styles->add('/css/first.css', null, 50);
$styles->addCond('ie6', '/css/ie6.css', ['media' => 'print']);
$styles->get();
/*
<link rel="stylesheet" href="/css/first.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/css/middle.css" type="text/css" media="print" />
<!--[if ie6]><link rel="stylesheet" href="/css/ie6.css" type="text/css" media="print" /><![endif]-->
<link rel="stylesheet" href="/css/last.css" type="text/css" media="screen" />
*/
?>
```

Tag: `$helper->tag($tag, array $attr = [])`

```php
<?php
$helper->tag('form', [
    'action' => '/action.php',
    'method' => 'post',
]);
// <form action="/action.php" method="post">

$helper->tag('div');
// <div>
?>
```

Title : 

```php
$title  = $helper->title();
$title->set('This and That');

$title->append(' Suf1');
$title->append(' Suf2');

$title->prepend('Pre1');
$title->prepend('Pre2');
        
$title->get();
// <title>Pre2Pre1This and That Suf1 Suf2</title>
``` 

The helpers escape values internally.

- need "radios" and "checkboxes" helpers
