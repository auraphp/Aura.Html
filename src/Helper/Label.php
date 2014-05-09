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
    /**
     * 
     * Returns a <label ... ></label> tag optionally enclosing an input.
     *
     * Typically, enclosing inputs would be used for radios and checkboxes.
     * 
     * 
     * @param string $label The text for the label.
     * 
     * @param array $attr Additional attributes for the tag.
     *
     * @param string $input An optional input to be wrapped by the label.
     * 
     * @return string A <label ... ></label> tag.
     * 
     * 
     */
    public function __invoke($label, $attr = array(), $input = null)
    {
        $attr = $this->escaper->attr((array) $attr);
        $html = array();
        
        if ($attr) {
            $label_start = "<label $attr>";
        } else {
            $label_start = "<label>";
        }
        
        $label_end = "</label>";
        
        if ($input) {
            $html[] = $this->indent(0, $label_start);
            $html[] = $this->indent(1, $input . $label);
            $html[] = $this->indent(0, $label_end);
        } else {
            $html[] = $label_start;
            $html[] = $label;
            $html[] = $label_end;
        }

        return implode('', $html);
    }
}
