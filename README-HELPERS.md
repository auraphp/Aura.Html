# Aura.Html Tag Helpers

Use a helper by calling it as a method on the _HelperLocator_. The available helpers are:

- [anchor](#anchor) / a
- [base](#base)
- [image](#image) / img
- [label](#label)
- [links](#links)
- [metas](#metas)
- [ol](#ol)
- [scripts](#scripts) / scriptsFoot
- [ul](#ul)
- [styles](#styles)
- [tag](#tag)
- [title](#title)

There is also a series of [helpers for forms](https://github.com/auraphp/Aura.Html/blob/functions/README-FORMS.md).

## anchor

```php
<?php
echo $helper->anchor('http://auraphp.com', 'Aura Project');
// <a href="http://auraphp.com">Aura Project</a>
?>
```

## base

```php
<?php
echo $helper->base('/base')
// <base href="/base" />
?>
```

## image

```php
<?php
echo $helper->img('hello.jpg', array('alt' => 'Hello', 'width' => 100, 'height' => 200));
// <img src="hello.jpg" alt="Hello" width="100" height="200">
?>
```

## label

```php
<?php
echo $helper->label('Label For Field', array('for' => 'field'));
// <label for="field">Label For Field</label>

echo $helper->label(
    'Foo: ',
    array('for' => 'foo'),
    $helper->input(array(
        'type' => 'text',
        'name' => 'foo',
        'value' => '',
        'attribs' => array(
            'id' => 'foo'
        ),
    )
));
// <label for="foo">Foo: <input type="text" id="foo" name="foo" value="" /></label>

## links 

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

## metas 

```php
<?php
echo $helper->metas()
    ->addHttp('Location', '/redirect/to/here');
    ->addName('foo', 'bar');

// <meta http-equiv="Location" content="/redirect/to/here">
// <meta name="foo" content="bar">
?>
```

## ol

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

## scripts

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

You can also set the order priority, and conditional scripts, as shown here:

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

## ul

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


## styles

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

## tag

A generic tag helper.

```php
<?php
echo $helper->tag('div', array(
    'id' => 'foo',
));
// <div id="foo">
?>
```

## title

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
