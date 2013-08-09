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
 * An HTML textarea input.
 * 
 * @package Aura.Html
 * 
 */
class Textarea extends AbstractInput
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
        $attribs = $this->escaper->attr($this->attribs);
        return "<textarea {$attribs}>{$this->value}</textarea>";
    }
}
