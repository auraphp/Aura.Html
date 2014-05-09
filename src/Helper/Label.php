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
 * Helper to generate an `<label ... ></label>` tag.
 * Optionally encloses an input element.
 * 
 * @package Aura.Html
 * 
 */
class Label extends AbstractHelper
{
    protected $attr;

    protected $before;

    protected $after;

    protected $label;

    /**
     * 
     * Returns a <label ... ></label> tag optionally enclosing an input.
     *
     * @param string $label The text for the label.
     * 
     * @param array $attr Additional attributes for the tag.
     *
     * @param string $input An optional input to be wrapped by the label.
     * 
     * @return self
     * 
     */
    public function __invoke($label, $attr = array())
    {
        $this->label = $label;
        $this->attr = (array) $attr;
        return $this;
    }

    /**
     * 
     * Place the label text before raw HTML.
     * 
     * @param string $before Place the label text before this raw HTML.
     * 
     * @return self
     * 
     */
    public function before($before)
    {
        $this->before = $before;
        $this->after = null;
        return $this;
    }

    /**
     * 
     * Place the label text after raw HTML.
     * 
     * @param string $after Place the label text after this raw HTML.
     * 
     * @return self
     * 
     */
    public function after($after)
    {
        $this->before = null;
        $this->after = $after;
        return $this;
    }

    /**
     * 
     * Returns the label string with the before/after HTML.
     * 
     * @return string
     * 
     */
    public function __toString()
    {
        $attr = $this->escaper->attr($this->attr);
        $html = trim("<label $attr") . ">"
              . $this->after
              . $this->label
              . $this->before
              . "</label>";

        $this->attr = null;
        $this->label = null;
        $this->html_before = null;
        $this->html_after = null;

        return $html;
    }
}
