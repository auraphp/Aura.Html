# Aura.Html Form Helpers

## The Form Element

Open and close a form element like so:

```html+php
<?php
echo $helper->form(array(
    'id' => 'my-form',
    'method' => 'put',
    'action' => '/hello-action',
));

echo $helper->tag('/form');
?>
<form id="my-form" method="put" action="/hello-action" enctype="multipart/form-data"></form>
```

## HTML 5 Input Elements

All of the HTML 5 input helpers use the same method signature: a single descriptor array that formats the input element.

```html+php
<?php
echo $helper->input(array(
    'type'    => $type,     // (string) the element type
    'name'    => $name,     // (string) the element name
    'value'   => $value,    // (string) the current value of the element
    'attribs' => array(),   // (array) element attributes
    'options' => array(),   // (array) options for select and radios
));
?>
```

The array is used so that other libraries can generate form element descriptions without needing to depend on Aura.Html for a particular object.

The available input element `type` values are:

- [button](#button)
- [checkbok](#checkbok)
- [color](#color)
- [date](#date)
- [datetime](#datetime)
- [datetime-local](#datetime-local)
- [email](#email)
- [file](#file)
- [hidden](#hidden)
- [image](#image)
- [month](#month)
- [number](#number)
- [password](#password)
- [radio](#radio)
- [range](#range)
- [reset](#reset)
- [search](#search)
- [select](#select) (including options)
- [submit](#submit)
- [tel](#tel)
- [text](#text)
- [textarea](#textarea)
- [time](#time)
- [url](#url)
- [week](#week)

### button

```html+php
<?php
echo $helper->input(array(
    'type'    => 'button',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="button" name="foo" value="bar" />
```

### checkbox

The `checkbox` type honors the `value_unchecked` pseudo-attribute as a way to specify a `hidden` element for the (you guessed it) unchecked value. It also honors the pseudo-element `label` to place a label after the checkbox.

```html+php
<?php
echo $helper->input(array(
    'type'    => 'checkbox',
    'name'    => 'foo',
    'value'   => 'y',               // the current value
    'attribs' => array(
        'label' => 'Check me',      // the checkbox label
        'value' => 'y',             // the value when checked
        'value_unchecked' => '0',   // the value when unchecked
    ),
));
?>
<input type="hidden" name="foo" value="n" />
<label><input type="checkbox" name="foo" value="y" checked /> Check me</label>
```

### color

```html+php
<?php
echo $helper->input(array(
    'type'    => 'color',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="color" name="foo" value="bar" />
```

### date

```html+php
<?php
echo $helper->input(array(
    'type'    => 'date',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="date" name="foo" value="bar" />
```

### datetime

```html+php
<?php
echo $helper->input(array(
    'type'    => 'datetime',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="datetime" name="foo" value="bar" />
```

### datetime-local

```html+php
<?php
echo $helper->input(array(
    'type'    => 'datetime-local',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="datetime-local" name="foo" value="bar" />
```

### email

```html+php
<?php
echo $helper->input(array(
    'type'    => 'email',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="email" name="foo" value="bar" />
```

### file

```html+php
<?php
echo $helper->input(array(
    'type'    => 'file',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="file" name="foo" value="bar" />
```

### hidden

```html+php
<?php
echo $helper->input(array(
    'type'    => 'hidden',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="hidden" name="foo" value="bar" />
```

### image

```html+php
<?php
echo $helper->input(array(
    'type'    => 'image',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="image" name="foo" value="bar" />
```

### month

```html+php
<?php
echo $helper->input(array(
    'type'    => 'month',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="month" name="foo" value="bar" />
```

### number

```html+php
<?php
echo $helper->input(array(
    'type'    => 'number',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="number" name="foo" value="bar" />
```

### password

```html+php
<?php
echo $helper->input(array(
    'type'    => 'password',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="password" name="foo" value="bar" />
```

### radio

This element type allows you to generate a single radio input, or multiple radio inputs if you pass an `options` element.

```html+php
<?php
echo $helper->input(array(
    'type'    => 'radio',
    'name'    => 'foo',
    'value'   => 'bar',     // (string) the currently selected radio
    'attribs' => array(),
    'options' => array(     // (array) `value => label` pairs
        'bar' => 'baz',
        'dib' => 'zim',
        'gir' => 'irk',
    ),
));
?>
<label><input type="radio" name="foo" value="bar" checked /> baz</label>
<label><input type="radio" name="foo" value="dib" /> zim</label>
<label><input type="radio" name="foo" value="gir" /> irk</label>
```

### range

```html+php
<?php
echo $helper->input(array(
    'type'    => 'range',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="range" name="foo" value="bar" />
```

### reset

```html+php
<?php
echo $helper->input(array(
    'type'    => 'reset',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="reset" name="foo" value="bar" />
```

### search

```html+php
<?php
echo $helper->input(array(
    'type'    => 'search',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="search" name="foo" value="bar" />
```

### select

Pseudo-attribute "placeholder".

```html+php
<?php
echo $helper->input(array(
    'type'    => 'select',
    'name'    => 'foo',
    'value'   => 'bar',
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
<select name="foo">
    <option disabled value="">Please pick one</option>
    <option value="value1">First Label</option>
    <option value="value2">Second Label</option>
    <option value="value5" selected>Fifth Label</option>
    <option value="value3">Third Label</option>
</select>
*/
?>
```

### submit

```html+php
<?php
echo $helper->input(array(
    'type'    => 'submit',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="submit" name="foo" value="bar" />
```

### tel

```html+php
<?php
echo $helper->irnput(array(
    'type'    => 'tel',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="tel" name="foo" value="bar" />
```

### text

```html+php
<?php
echo $helper->input(array(
    'type'    => 'text',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="text" name="foo" value="bar" />
```

### textarea

```html+php
<?php
echo $helper->input(array(
    'type'    => 'textarea',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<textarea name="foo">bar</textarea>
```

### time

```html+php
<?php
echo $helper->input(array(
    'type'    => 'time',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="time" name="foo" value="bar" />
```

### url

```html+php
<?php
echo $helper->input(array(
    'type'    => 'url',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="url" name="foo" value="bar" />
```

### week

```html+php
<?php
echo $helper->input(array(
    'type'    => 'week',
    'name'    => 'foo',
    'value'   => 'bar',
    'attribs' => array()
));
?>
<input type="week" name="foo" value="bar" />
```
