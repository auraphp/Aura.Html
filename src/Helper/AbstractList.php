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
 * Helper for `<ul>` tag with `<li>` items.
 * 
 * @package Aura.Html
 * 
 */
abstract class AbstractList extends AbstractHelper
{
    /**
     * 
     * Attributes for the ul tag.
     * 
     * @var array
     * 
     */
    protected $attr = array();
    
    /**
     * 
     * The stack of HTML elements.
     * 
     * @var array
     * 
     */
    protected $stack = array();
    
    /**
     * 
     * The generated HTML.
     * 
     * @var string
     * 
     */
    protected $html = '';
    
    /**
     * 
     * Initializes and returns the UL object.
     * 
     * @param array $attr Attributes for the UL tag.
     * 
     * @return self
     * 
     */
    public function __invoke(array $attr = null)
    {
        if ($attr !== null) {
            $this->attr = $attr;
        }
        return $this;
    }
    
    /**
     * 
     * Generates and returns the HTML for the list.
     * 
     * @return string
     * 
     */
    public function __toString()
    {
        // if there is no stack of items, **do not** return an empty
        // <ul></ul> tag set.
        if (! $this->stack) {
            return;
        }
        
        $tag = $this->getTag();
        $attr = $this->escaper->attr($this->attr);
        if ($attr) {
            $this->html = $this->indent(0, "<{$tag} {$attr}>");
        } else {
            $this->html = $this->indent(0, "<{$tag}>");
        }
        
        foreach ($this->stack as $item) {
            $this->buildItem($item);
        }
        
        $html = $this->html . $this->indent(0, "</{$tag}>");

        $this->attr  = array();
        $this->stack = array();
        $this->html  = '';

        return $html;
    }
    
    /**
     * 
     * Adds a single item to the stack.
     * 
     * @param string $html The HTML for the list item text.
     * 
     * @param array $attr Attributes for the list item tag.
     * 
     * @return self
     * 
     */
    public function item($html, array $attr = array())
    {
        $this->stack[] = array($html, $attr);
        return $this;
    }
    
    /**
     * 
     * Adds multiple items to the stack.
     * 
     * @param array $items An array of HTML for the list items.
     * 
     * @param array $attr Attributes for each list item tag.
     * 
     * @return self
     * 
     */
    public function items(array $items, array $attr = array())
    {
        foreach ($items as $html) {
            $this->item($html, $attr);
        }
        return $this;
    }
    
    /**
     * 
     * Builds the HTML for a single list item.
     * 
     * @param string $item The item HTML.
     * 
     * @return null
     * 
     */
    protected function buildItem($item)
    {
        list($html, $attr) = $item;
        $attr = $this->escaper->attr($attr);
        if ($attr) {
            $this->html .= $this->indent(1, "<li {$attr}>$html</li>");
        } else {
            $this->html .= $this->indent(1, "<li>$html</li>");
        }
    }
    
    /**
     * 
     * Returns the tag name.
     * 
     * @return string
     * 
     */
    abstract protected function getTag();
}
