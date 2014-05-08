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
 * Helper for a stack of <link ... /> tags.
 * 
 * @package Aura.Html
 * 
 */
class Links extends AbstractHelper
{
    /**
     * 
     * The array of all links added to the helper.
     * 
     * @var array
     * 
     */
    protected $links = array();

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

    public function __toString()
    {
        return $this->indent(1, implode(PHP_EOL . $this->indent, $this->links));
    }

    /**
     * 
     * Adda a <link ... > tag to the stack.
     * 
     * @param array $attr Attributes for the <link> tag.
     * 
     * @return self
     * 
     */
    public function add(array $attr = array())
    {
        $this->links[] = $this->void('link', $attr);
        return $this;
    }
}
