<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @license http://opensource.org/licenses/MIT-license.php MIT
 *
 */
namespace Aura\Html\Helper\Input;

use Aura\Html\Exception\InvalidArgument;

/**
 *
 * Abstact helper for inputs that can be checked (e.g. radio or checkbox).
 *
 * @package Aura.Html
 *
 */
abstract class AbstractChecked extends AbstractInput
{
    /**
     *
     * The label for the input, if any.
     *
     * @var string
     *
     */
    protected $label;

    /**
     *
     * Per-option HTML attributes for multi-option inputs (checkbox, radio).
     * Keyed by option value.
     *
     * @var array<string, array<string, scalar|null>>
     *
     */
    protected $options_attribs = array();

    /**
     *
     * Use strict equality when setting the checked value?
     *
     * @var bool
     *
     */
    protected $strict = false;

    /**
     *
     * Use strict equality when setting the checked value?
     *
     * @param bool $strict True for strict equality, false for loose equality.
     *
     * @return self
     *
     */
    public function strict($strict = true)
    {
        $this->strict = (bool) $strict;
        return $this;
    }

    /**
     *
     * Prepares the properties on this helper.
     *
     * Normalises per-option specs so that an option value may be either a
     * plain label string (backward-compatible) or an array of the form:
     *
     *   ['label' => 'My Label', 'attribs' => ['class' => 'foo', 'data-x' => 1]]
     *
     * Per-option attribs are merged on top of the shared attribs at render
     * time, so they can override global attributes.
     *
     * @param array $spec The specification array.
     *
     * @return void
     *
     */
    protected function prep(array $spec)
    {
        $this->options_attribs = array();
        parent::prep($spec);

        foreach ($this->options as $value => $option) {
            if (is_array($option)) {
                $attribs = $option['attribs'] ?? array();
                if (! is_array($attribs)) {
                    throw new InvalidArgument(
                        "Option 'attribs' must be an array for option '{$value}'."
                    );
                }
                $this->options_attribs[$value] = $attribs;
                $this->options[$value] = isset($option['label']) ? $option['label'] : '';
            }
        }
    }

    /**
     *
     * Returns the HTML for the "checked" part of the input.
     *
     * @return string
     *
     */
    protected function htmlChecked()
    {
        $this->setLabel();
        $this->setChecked();
        return $this->void('input', $this->attribs);
    }

    /**
     *
     * Extracts and retains the "label" pseudo-attribute.
     *
     * @return void
     *
     */
    protected function setLabel()
    {
        $this->label = null;
        if (! isset($this->attribs['label'])) {
            return;
        }

        $this->label = $this->attribs['label'];
        unset($this->attribs['label']);
    }

    /**
     *
     * Sets the "checked" attribute appropriately.
     *
     * @return void
     *
     */
    protected function setChecked()
    {
        $this->attribs['checked'] = false;

        if (! array_key_exists('value', $this->attribs)) {
            return;
        }

        if ($this->strict) {
            $this->attribs['checked'] = in_array($this->attribs['value'], (array)$this->value, true);
            return;
        }

        $this->attribs['checked'] = in_array($this->attribs['value'], (array)$this->value, false);
    }

    /**
     *
     * Returns the HTML for a "label" (if any) wrapped around the input.
     *
     * @param string $input The input to be wrapped by the label.
     *
     * @return string
     *
     */
    protected function htmlLabel($input)
    {
        if (! $this->label) {
            return $input;
        }

        $label = $this->escaper->html($this->label);

        if (isset($this->attribs['id'])) {
            $attribs = $this->escaper->attr(array('for' => $this->attribs['id']));
            return "<label {$attribs}>{$input} {$label}</label>";
        }

        return "<label>{$input} {$label}</label>";
    }
}
