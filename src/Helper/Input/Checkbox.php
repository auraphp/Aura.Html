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
namespace Aura\Html\Helper\Input;

/**
 * 
 * An HTML checkbox input.
 * 
 * @package Aura.Html
 * 
 */
class Checkbox extends AbstractChecked
{
    /**
     * 
     * Returns the HTML for the input.
     * 
     * @return string
     * 
     */
    protected function html()
    {
        $this->attribs['type'] = 'checkbox';
        $input = $this->htmlUnchecked() . $this->htmlChecked();
        $html  = $this->htmlLabel($input);
        return $this->indent(0, $html);
    }
    
    /**
     * 
     * Returns the HTML for the "unchecked" part of the input.
     * 
     * @return string
     * 
     */
    protected function htmlUnchecked()
    {
        if (! isset($this->attribs['value_unchecked'])) {
            return;
        }
        
        $unchecked = $this->attribs['value_unchecked'];
        unset($this->attribs['value_unchecked']);
        
        $attribs = array(
            'type' => 'hidden',
            'value' => $unchecked,
            'name' => $this->name
        );
        
        return $this->void('input', $attribs);
    }
}
