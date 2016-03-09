<?php
/**
 *
 * This file is part of Aura for PHP.
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
     * Individual attributes for each option (only for multi checkbox)
     *
     * @var array
     *
     */
    protected $options_attribs = array();

    /**
     *
     * Prepares the properties on this helper.
     *
     * @param array $spec The specification array.
     *
     */
    protected function prep(array $spec)
    {
        if (isset($spec['options_attribs'])) {
            $this->options_attribs = $spec['options_attribs'];
            unset($spec['options_attribs']);
        }

        parent::prep($spec);
    }

    /**
     *
     * Returns the HTML for the input.
     *
     * @return string
     *
     */
    public function __toString()
    {
        $this->attribs['type'] = 'checkbox';

        if ($this->options) {
            return $this->multiple();
        }

        // Get unchecked element first. This unsets value_unchecked
        $unchecked = $this->htmlUnchecked();

        // Get the input
        $input = $this->htmlChecked();

        // Unchecked (hidden) element must reside outside the label
        $html  = $unchecked . $this->htmlLabel($input);

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

    protected function multiple()
    {
        $html = '';
        $checkbox = clone($this);

        $this->attribs['name'] .= '[]';

        foreach ($this->options as $value => $label) {
            $this->attribs['value'] = $value;
            $this->attribs['label'] = $label;

            $option_attribs = isset($this->options_attribs[$value]) ? $this->options_attribs[$value] : array();

            $html .= $checkbox(array(
                'name'    => $this->attribs['name'],
                'value'   => $this->value,
                'attribs' => $this->attribs + $option_attribs
            ));
        }
        return $html;
    }
}
