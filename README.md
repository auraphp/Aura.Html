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

### Forms

Open and close a form element like so:

```php
<?php
// <form id="my-form" method="put" action="/hello-action" enctype="multipart/form-data">
echo $helper->form(array(
    'id' => 'my-form',
    'method' => 'put',
    'action' => '/hello-action',
));

// </form>
echo $helper->tag('/form');
?>
```

Emit HTML 5 input elements between the form tags. All of the input helpers use the same method signature: a single descriptor array that formats the input element.

```php
<?php
echo $helper->input(array(
    'type'    => $type,
    'name'    => $name,
    'value'   => $value,
    'attribs' => array(),
    'options' => array(), // for select elements
));
?>
```

(The array is used so that other libraries can generate form element descriptions without needing to depend on Aura.Html for a particular object.)

#### checkbox

```php
<?php
// the element value of 'bar' does not match the attribs value of 'baz'; therefore, the element is not checked
echo $helper->input(array(
    'type'    => 'checkbox',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array(
        'value' => 'baz',
    ),
    'options' => array(),
));
// <input type="checkbox" name="foo" value="baz" />


// the element value is 'baz' matches the attribs value of 'baz';
// therefore, the element is checked
echo $helper->input(array(
    'type'    => 'checkbox',
    'name'    => 'foo',
    'value'   => 'baz',
    'attribs' => array(
        'value' => 'baz',
    ),
    'options' => array(),
));
// <input type="checkbox" name="foo" value="baz" checked />


echo $helper->input(array(
    'type'    => 'checkbox',
    'value'   => 'no',
    'name'    => 'dim',
    'attribs' => array(
        'value' => 'yes',
        'label' => 'This is yes',
        'id'    =>'cbox',
    )
));
// <label for="cbox"><input id="cbox" type="checkbox" name="dim" value="yes" /> This is yes</label>


echo $helper->input(array(
    'type'    => 'checkbox',
    'name'    => 'foo',
    'value'   => 'yes',
    'attribs' => array(
        'value' => 'yes',
        'value_unchecked' => 'no',
        'label' => 'This is yes',
    ),
));

// <input type="hidden" value="no" name="foo" /><label><input type="checkbox" name="foo" value="yes" checked /> This is yes</label>

?>
```

#### radio

```php
<?php
$options = array(
    'foo' => 'bar',
    'baz' => 'dib',
    'zim' => 'gir',
);

echo $helper->input(array(
    'type'    => 'radio',
    'name'    => 'field',
    'value'   => 'baz',
    'attribs' => array(),
    'options' => $options,
));

// <label><input type="radio" name="field" value="foo" /> bar</label>
// <label><input type="radio" name="field" value="baz" checked /> dib</label>
// <label><input type="radio" name="field" value="zim" /> gir</label>
?>
```

#### select

```php
<?php
echo $helper->input(array(
    'type'    => 'select',
    'name'    => 'foo[bar]',
    'value'   => 'value5',
    'attribs' => array(
        'placeholder' => 'Please pick one',
    ),
    'options' => array(
        'value1' => 'First Label',
        'value2' => 'Second Label',
        'value5' => 'Fifth Label',
        'value3' => 'Third Label',
    ),
));

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

#### textarea

```php
<?php
echo $helper->input(array(
    'type'    => 'textarea',
    'name'    => 'field',
    'value'   => 'the quick brown fox',
));
// <textarea name="field">the quick brown fox</textarea>
?>
```

button

```php
<?php
echo $helper->input(array(
    'type'    => 'button',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="button" name="name" value="value" />
?>
```

color

```php
<?php
echo $helper->input(array(
    'type'    => 'color',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="color" name="name" value="value" />
?>
```

date

```php
<?php
echo $helper->input(array(
    'type'    => 'date',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="date" name="name" value="value" />
?>
```

datetime

```php
<?php
echo $helper->input(array(
    'type'    => 'datetime',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="datetime" name="name" value="value" />
?>
```

datetime-local

```php
<?php
echo $helper->input(array(
    'type'    => 'datetime-local',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="datetime-local" name="name" value="value" />
?>
```

email

```php
<?php
echo $helper->input(array(
    'type'    => 'email',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="email" name="name" value="value" />
?>
```

file

```php
<?php
echo $helper->input(array(
    'type'    => 'file',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="file" name="name" value="value" />
?>
```

hidden

```php
<?php
echo $helper->input(array(
    'type'    => 'hidden',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="hidden" name="name" value="value" />
?>
```

image

```php
<?php
echo $helper->input(array(
    'type'    => 'image',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="image" name="name" value="value" />
?>
```

month

```php
<?php
echo $helper->input(array(
    'type'    => 'month',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="month" name="name" value="value" />
?>
```

number

```php
<?php
echo $helper->input(array(
    'type'    => 'number',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="number" name="name" value="value" />
?>
```

password

```php
<?php
echo $helper->input(array(
    'type'    => 'password',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="password" name="name" value="value" />
?>
```

range

```php
<?php
echo $helper->input(array(
    'type'    => 'range',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="range" name="name" value="value" />
?>
```

reset

```php
<?php
echo $helper->input(array(
    'type'    => 'reset',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="reset" name="name" value="value" />
?>
```

search

```php
<?php
echo $helper->input(array(
    'type'    => 'search',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="search" name="name" value="value" />
?>
```

submit

```php
<?php
echo $helper->input(array(
    'type'    => 'submit',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="submit" name="name" value="value" />
?>
```

tel

```php
<?php
echo $helper->irnput(array(
    'type'    => 'tel',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="tel" name="name" value="value" />
?>
```

text

```php
<?php
echo $helper->input(array(
    'type'    => 'text',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="text" name="name" value="value" />
?>
```

time

```php
<?php
echo $helper->input(array(
    'type'    => 'time',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="time" name="name" value="value" />
?>
```

url

```php
<?php
echo $helper->input(array(
    'type'    => 'url',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="url" name="name" value="value" />
?>
```

week

```php
<?php
echo $helper->input(array(
    'type'    => 'week',
    'name'    => 'name',
    'value'   => 'value',
    'attribs' => array(),
    'options' => array(),
));

// <input type="week" name="name" value="value" />
?>
```

Anchor : `echo $helper->anchor($href, $text, array $attr = array());`

```php
<?php
echo $helper->anchor('http://auraphp.com', 'Aura Project');
// <a href="http://auraphp.com">Aura Project</a>
?>
```

Attribs : `echo $helper->attr();`

```php
<?php
echo $helper->attr(array(
    'class'=>'myclass',
    'id'=>'myid',
    'data-orbit'=>true
));

// class="myclass" id="myid" data-orbit

?>
``` 

Base : `echo $helper->base($href);`

```php
<?php
echo $helper->base('/base')
// <base href="/base" />
?>
```

Image : `echo $helper->img($src, array $attr = array());`

```php
<?php
echo $helper->img('hello.jpg', array('alt' => 'Hello', 'width' => 100, 'height' => 200));
// <img src="hello.jpg" alt="Hello" width="100" height="200">
?>
```

Links : 

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

echo $helper->links()->get();
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
    ))
    ->get();
?>
```

Metas : 

```php
<?php
echo $helper->metas()
    ->addHttp('Location', '/redirect/to/here');
    ->addName('foo', 'bar')
    ->get();

// <meta http-equiv="Location" content="/redirect/to/here">
// <meta name="foo" content="bar">
?>
```

Ordered list (ol) :

```php
<?php
$ol = $helper->ol(array('id' => 'test'));
$ol->items(array('foo', 'bar', 'baz'))
    ->item('dib', array('class' => 'callout'))
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
echo $helper->ul(array('id' => 'test'])
    ->items(array('foo', 'bar', 'baz'))
    ->item('dib', array('class' => 'callout'))
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
echo $helper->scripts()
    ->add('/js/first.js')
    ->add('/js/middle.js')
    ->add('/js/last.js')
    ->get();

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
    ->addCond('ie6', '/js/ie6.js')
    ->get();
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
$helper->styles()->add('/css/middle.css', array('media' => 'print'));
$helper->styles()->add('/css/last.css', null, 150);
$helper->styles()->add('/css/first.css', null, 50);
$helper->styles()->addCond('ie6', '/css/ie6.css', array('media' => 'print'));
echo $helper->styles()->get();
/*
<link rel="stylesheet" href="/css/first.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/css/middle.css" type="text/css" media="print" />
<!--[if ie6]><link rel="stylesheet" href="/css/ie6.css" type="text/css" media="print" /><![endif]-->
<link rel="stylesheet" href="/css/last.css" type="text/css" media="screen" />
*/
?>
```

Tag: `echo $helper->tag($tag, array $attr = array())`

```php
<?php
echo $helper->tag('form', array(
    'action' => '/action.php',
    'method' => 'post',
));
// <form action="/action.php" method="post">

echo $helper->tag('div');
// <div>
?>
```

Title : 

```php
<?php
$helper->title()->set('This and That');

$helper->title()->append(' Suf1');
$helper->title()->append(' Suf2');

$helper->title()->prepend('Pre1');
$helper->title()->prepend('Pre2');
        
$helper->title()->get();
// <title>Pre2Pre1This and That Suf1 Suf2</title>
?>
``` 


