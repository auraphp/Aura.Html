# Aura.Html Forms

## The <form> Tag

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

## Input Elements

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


### checkbox

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

### button

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

### color

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

### date

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

### datetime

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

### datetime-local

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

### email

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

### file

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

### hidden

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

### image

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

### month

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

### number

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

### password

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

### radio

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

### range

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

### reset

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

### search

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

### select

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

### submit

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

### tel

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

### text

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

### textarea

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

### time

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

### url

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

### week

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
