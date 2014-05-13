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
 * Abstract helper for element stacks with positional ordering.
 * 
 * @package Aura.Html
 * 
 */
abstract class AbstractStack extends AbstractHelper
{
    /**
     * 
     * The array of all elements added to the helper.
     * 
     * @var array
     * 
     */
    protected $stack = array();

    /**
     * 
     * Returns the helper so you can call methods on it.
     * 
     * @return self
     * 
     */
    public function __invoke()
    {
        return $this;
    }

    /**
     * 
     * Returns the stack of elements as a single block.
     * 
     * @return string The element tags.
     * 
     */
    public function __toString()
    {
        $html = '';
        ksort($this->stack);
        foreach ($this->stack as $elements) {
            foreach ($elements as $element) {
                $html .= $this->indent . $element . PHP_EOL;
            }
        }
        $this->stack = array();
        return $html;
    }

    protected function addToStack($pos, $element)
    {
        $this->stack[(int) $pos][] = $element;
    }
}
