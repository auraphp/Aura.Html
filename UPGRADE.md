# Upgrading from 2.x to 6.0

Version 6.0 is the first release of Aura.Html since 2.6.0. Most of the library
is unchanged: the escapers, the helper locator, and every tag and form helper
keep the names, arguments, and output they had in 2.x. What follows is the
complete list of things that can break an existing application, in the order
you are likely to hit them.

## PHP 8.4 or later is required

2.x ran on PHP 5.3 and up. 6.0 requires PHP 8.4. There is no intermediate
release, so upgrade PHP first and the library second.

As before, the library needs one of the `mbstring` or `iconv` extensions and
has no userland dependencies.

## The Aura.Di integration is gone

2.x shipped a `config/` directory with `Aura\Html\_Config\Common`, wired in
through the `extra.aura` key in `composer.json`. Both are removed. If you
relied on the Aura.Di configuration to get a helper locator, build one
yourself:

```php
use Aura\Html\HelperLocatorFactory;

$factory = new HelperLocatorFactory();
$helper = $factory->newInstance();
```

Register that as a service in whatever container you use.

## The root `autoload.php` is gone

2.x carried an `autoload.php` at the package root for use without Composer.
Install through Composer and use its autoloader instead.

## `Title::__toString()` no longer clears the title

In 2.x, rendering the title emptied it, so a second render produced
`<title></title>`. That behaviour is fixed, not preserved: the title now
survives rendering, and you can read it back or keep modifying it afterwards.

```php
$helper->title()->set('Café & Bistro');
echo $helper->title();          // <title>Café &amp; Bistro</title>
echo $helper->title();          // 2.x: <title></title>   6.0: the same title
```

If any of your code depended on the reset — for instance, rendering a title
once per request and expecting the next render to come out empty — set the
title explicitly instead.

Two methods come with the fix. `get()` returns the escaped title for HTML
contexts, and `getRaw()` returns the unescaped text for places that are not
HTML, such as an `og:title` meta tag. `getRaw()` is reliable only when the
title was built with the escaping methods (`set()`, `append()`, `prepend()`);
mixing in the raw variants makes it untrustworthy.

## `type` attributes are no longer emitted on styles and scripts

The `Styles` helper no longer writes `type="text/css"` on `<link>` and
`<style>` tags, and the `Scripts` helper no longer writes
`type="text/javascript"` on `<script>` tags. Both are the HTML5 defaults and
have been optional for years.

```html
<!-- 2.x -->
<link rel="stylesheet" href="/css/site.css" type="text/css" media="screen" />
<script src="/js/site.js" type="text/javascript"></script>

<!-- 6.0 -->
<link rel="stylesheet" href="/css/site.css" media="screen" />
<script src="/js/site.js"></script>
```

Nothing in a browser cares, but tests that compare rendered markup string by
string will need their expectations updated. Pass `type` yourself in the
attributes array if you need it back.

## Nullable parameter types on helper methods

Optional array parameters that used to be declared `array $attr = null` are now
declared `?array $attr = null`. The old form is implicitly nullable, which PHP
8.4 deprecates and PHP 9 will remove. Calling code is unaffected.

If you extend a helper and override one of these methods, the old signature is
still compatible and still runs -- but it emits a deprecation notice on every
load, so update it:

```php
// before
protected function fixAttr($href, array $attr = null)

// after
protected function fixAttr($href, ?array $attr = null)
```

## The license changed from BSD to MIT

Both are permissive and the change is unlikely to affect you, but check it
against your own policies if you track license terms.

## New in 6.0

Nothing here is required, but you may want it once you have upgraded:

- Per-option HTML attributes on multi-option `checkbox` and `radio` inputs.
  Each entry in `options` can now be either a plain label string, exactly as
  before, or an array of `['label' => '...', 'attribs' => [...]]`. Per-option
  attributes are merged on top of the shared ones and can override them. See
  the [form helpers](./docs/form-helpers.md) documentation.
- `Title::get()` and `Title::getRaw()`, described above. See the
  [tag helpers](./docs/tag-helpers.md) documentation.
- `@method` annotations on `HelperLocator`, so editors can autocomplete the
  built-in helpers.
