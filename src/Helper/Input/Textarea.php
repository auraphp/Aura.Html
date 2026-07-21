<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @license http://opensource.org/licenses/MIT-license.php MIT
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
    public function __toString()
    {
        $attribs = $this->escaper->attr($this->attribs);
        $value = $this->escaper->html($this->value);
        return "<textarea {$attribs}>{$value}</textarea>";
    }
}
