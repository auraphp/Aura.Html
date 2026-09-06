## Upgrading from 2.x to 6.0

**If you only ever called Aura.Html, you likely have nothing to change beyond the PHP version.** The escapers, the _HelperLocator_, and every tag and form helper keep the names, arguments, and output they had in 2.6 -- with two exceptions, covered in steps 4 and 5 below. The remaining changes affect wiring and classes that *extend* Aura.Html.

Version 6.0 is the first release since 2.6.0. The version jumps 2.x to 6.x to keep step with the rest of the suite (Aura.Filter `6.x`, Aura.Auth `6.x`, Aura.Router `6.x`, Aura.View `6.x`); there is no 3.x, 4.x, or 5.x.

Work through these in order.

### 1. Move to PHP 8.4

2.x ran on PHP 5.3 and up. 6.0 requires PHP 8.4, so upgrade PHP first and the library second.

```
composer require aura/html:^6.0
```

As before, the library needs one of the `mbstring` or `iconv` extensions and has no userland dependencies.

### 2. Move The DI Wiring Into Your Own Container Config

`config/Common.php` and the `extra.aura` block in `composer.json` are gone, along with the `Aura\Html\_Config\` entry. If you relied on the Aura.Di configuration to get a helper locator, build one yourself and register it as a service in whatever container you use:

```php
<?php
use Aura\Html\HelperLocatorFactory;

$factory = new HelperLocatorFactory();
$helpers = $factory->newInstance();
?>
```

### 3. Install Through Composer

2.x carried an `autoload.php` at the package root for use without Composer. It is gone; use Composer's autoloader.

### 4. Update Any Tests That Compare Styles Or Scripts Markup

This is the change most likely to show up as a failing test rather than a broken page. The _Styles_ helper no longer writes `type="text/css"` on `<link>` and `<style>` tags, and the _Scripts_ helper no longer writes `type="text/javascript"` on `<script>` tags. Both are the HTML5 defaults and have been optional for years.

```html
<!-- 2.x -->
<link rel="stylesheet" href="/css/site.css" type="text/css" media="screen" />
<script src="/js/site.js" type="text/javascript"></script>

<!-- 6.0 -->
<link rel="stylesheet" href="/css/site.css" media="screen" />
<script src="/js/site.js"></script>
```

No browser cares, but string-by-string assertions on rendered markup will need updating. Pass `type` yourself in the attributes array if you want it back.

### 5. Stop Relying On The Title Resetting Itself

In 2.x, rendering the title emptied it, so a second render produced `<title></title>`. That is fixed, not preserved: the title now survives rendering, and you can read it back or keep modifying it afterwards.

```php
<?php
$helpers->title()->set('Café & Bistro');
echo $helpers->title();     // <title>Café &amp; Bistro</title>
echo $helpers->title();     // 2.x: <title></title>   6.0: the same title again
?>
```

If any code depended on the reset -- rendering a title once per request and expecting the next render to come out empty -- set the title explicitly instead.

### 6. Add Explicit Nullability To Any Signatures You Override

Optional array parameters that used to be declared `array $attr = null` are now declared `?array $attr = null`. The old form is implicitly nullable, which PHP 8.4 deprecates and PHP 9 will remove. Calling code is unaffected.

If you extend a helper and override one of these methods, the old signature is still compatible and still runs -- but it emits a deprecation notice on every load, so update it:

```php
<?php
// 2.x
protected function fixAttr($href, array $attr = null)

// 6.x
protected function fixAttr($href, ?array $attr = null)
?>
```

### Things That Are Not A Problem

- **The escapers.** `Escaper::h()`, `a()`, `c()`, `j()`, the statics, and _EscaperFactory_ all behave as they did in 2.x.

- **The helper locator.** _HelperLocator_ and _HelperLocatorFactory_ keep their API, including `set()` for registering your own helpers and the `$helpers` and `$input_helpers` arguments to `newInstance()` for overriding the built-in ones.

- **Every other helper's output.** Tag helpers, form helpers, input helpers, and the list and series helpers render exactly what they rendered in 2.6. Steps 4 and 5 are the only output changes.

- **The Aura.View wiring.** `$view_factory->newInstance($helpers)` with a _HelperLocator_ works exactly as it did, with no adapter. See [Using Aura.Html Helpers](https://github.com/auraphp/Aura.View/blob/6.x/docs/helpers.md#using-aurahtml-helpers) in the Aura.View docs.

- **The license.** It changed from BSD to MIT. Both are permissive; check it against your own policies only if you track license terms.

### New In 6.0

Nothing here is required, but you may want it once you have upgraded:

- **Per-option attributes on checkbox and radio inputs.** Each entry in `options` can now be either a plain label string, exactly as before, or an array of `['label' => '...', 'attribs' => [...]]`. Per-option attributes are merged on top of the shared ones and can override them. See [Form Helpers](form-helpers.md).

- **`Title::get()` and `Title::getRaw()`.** `get()` returns the escaped title for HTML contexts; `getRaw()` returns the unescaped text for places that are not HTML, such as an `og:title` meta tag. `getRaw()` is reliable only when the title was built with the escaping methods (`set()`, `append()`, `prepend()`); mixing in the raw variants makes it untrustworthy. See [Tag Helpers](tag-helpers.md).

- **`@method` annotations on _HelperLocator_,** so editors can autocomplete the built-in helpers.

The full list of changes is in [CHANGELOG.md](https://github.com/auraphp/Aura.Html/blob/6.x/CHANGELOG.md).
