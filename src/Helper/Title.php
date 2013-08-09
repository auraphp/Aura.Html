<?php
/**
 * 
 * This file is part of Aura for PHP.
 * 
 * @package Aura.Html
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
     * The title value.
     * 
     * @var string
     * 
     */
    protected $title = null;

    /**
     * 
     * Returns the helper so you can call methods on it.
     * 
     * @return $this
     * 
     */
    public function __invoke()
    {
        return $this;
    }

    /**
     * 
     * Sets the <title> string.
     * 
     * @param string $title The title string.
     * 
     * @return void
     * 
     */
    public function set($title)
    {
        $this->title = $title;
    }

    /**
     * 
     * Appends to the end of the current <title> string.
     * 
     * @param string $text The string to be appended to the title.
     * 
     * @return void
     * 
     */
    public function append($text)
    {
        $this->title .= $text;
    }

    /**
     * 
     * Prepends to the beginning of the current <title> string.
     * 
     * @param string $text The string to be appended to the title.
     * 
     * @return void
     * 
     */
    public function prepend($text)
    {
        $this->title = $text . $this->title;
    }

    /**
     * 
     * Returns the current title string.
     * 
     * @return string The current title string.
     * 
     */
    public function get()
    {
        $html = "<title>" . $this->escaper->html($this->title) . "</title>";
        return $this->indent(1, $html);
    }
}
