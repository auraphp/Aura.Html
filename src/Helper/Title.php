<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 *
 */
namespace Aura\Html\Helper;

/**
 *
 * Helper to generate a `<title>` tag.
 *
 * @package Aura.Html
 *
 */
class Title extends AbstractHelper
{
    /**
     *
     * The escaped title value (for HTML output).
     *
     * @var string
     *
     */
    protected $title = null;

    /**
     *
     * The raw (unescaped) title value.
     *
     * @var string
     *
     */
    protected $rawTitle = null;

    /**
     *
     * Returns the helper so you can call methods on it; alternatively, if you
     * pass a title string, it will be as you called `append()`.
     *
     * @param string $text Text to append to the existing title.
     *
     * @return self
     *
     */
    public function __invoke($text = null)
    {
        if ($text) {
            $this->append($text);
        }
        return $this;
    }

    /**
     *
     * Returns the current title string.
     *
     * @return string The current title string.
     *
     */
    public function __toString()
    {
        return $this->indent(1, "<title>{$this->title}</title>");
    }

    /**
     *
     * Returns the escaped title string for use in HTML contexts.
     *
     * @return string The escaped title string.
     *
     */
    public function get()
    {
        return (string) $this->title;
    }

    /**
     *
     * Returns the raw (unescaped) title string for use in non-HTML contexts
     * such as og:title meta tags or JavaScript.
     *
     * @return string The raw title string.
     *
     */
    public function getRaw()
    {
        return (string) $this->rawTitle;
    }

    /**
     *
     * Escapes and sets text as the <title> string.
     *
     * @param string $text The title string.
     *
     * @return self
     *
     */
    public function set($text)
    {
        $this->title = $this->escaper->html($text);
        $this->rawTitle = $text;
        return $this;
    }

    /**
     *
     * Sets raw text as the <title> string.
     *
     * @param string $text The title string.
     *
     * @return self
     *
     */
    public function setRaw($text)
    {
        $this->title = $text;
        $this->rawTitle = $text;
        return $this;
    }

    /**
     *
     * Escapes and appends text to the end of the current <title> string.
     *
     * @param string $text The string to be appended to the title.
     *
     * @return self
     *
     */
    public function append($text)
    {
        $this->title .= $this->escaper->html($text);
        $this->rawTitle .= $text;
        return $this;
    }

    /**
     *
     * Appends raw text to the end of the current <title> string.
     *
     * @param string $text The string to be appended to the title.
     *
     * @return self
     *
     */
    public function appendRaw($text)
    {
        $this->title .= $text;
        $this->rawTitle .= $text;
        return $this;
    }

    /**
     *
     * Escapes and prepends text to the beginning of the current <title> string.
     *
     * @param string $text The string to be appended to the title.
     *
     * @return self
     *
     */
    public function prepend($text)
    {
        $this->title = $this->escaper->html($text) . $this->title;
        $this->rawTitle = $text . $this->rawTitle;
        return $this;
    }

    /**
     *
     * Prepends raw text to the beginning of the current <title> string.
     *
     * @param string $text The string to be appended to the title.
     *
     * @return self
     *
     */
    public function prependRaw($text)
    {
        $this->title = $text . $this->title;
        $this->rawTitle = $text . $this->rawTitle;
        return $this;
    }
}
