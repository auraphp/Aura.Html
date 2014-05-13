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
 * Helper for <link rel="stylesheet" ... /> tags.
 * 
 * @package Aura.Html
 * 
 */
class Styles extends AbstractHelper
{
    /**
     * 
     * The array of all styles added to the helper.
     * 
     * @var array
     * 
     */
    protected $styles = array();

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
     * Returns the stack of <link rel="stylesheet" ... /> tags as a single 
     * block.
     * 
     * @return string The <link rel="stylesheet" ... /> tags.
     * 
     */
    public function __toString()
    {
        $html = '';
        ksort($this->styles);
        foreach ($this->styles as $styles) {
            foreach ($styles as $style) {
                $html .= $this->indent . $style . PHP_EOL;
            }
        }
        $this->styles = array();
        return $html;
    }

    /**
     * 
     * Adds a <link rel="stylesheet" ... /> tag to the stack.
     * 
     * @param string $href The source href for the stylesheet.
     * 
     * @param array $attr Additional attributes for the <link> tag.
     * 
     * @param int $pos The stylesheet position in the stack.
     * 
     * @return self
     * 
     */
    public function add($href, array $attr = null, $pos = 100)
    {
        $attr = $this->fixAttr($href, $attr);
        $tag = $this->void('link', $attr);
        $this->styles[(int) $pos][] = $tag;

        return $this;
    }

    /**
     * 
     * Adds a conditional `<!--[if ...]><link rel="stylesheet" ... /><![endif] -->` 
     * tag to the stack.
     * 
     * @param string $cond The conditional expression for the stylesheet.
     * 
     * @param string $href The source href for the stylesheet.
     * 
     * @param array $attr Additional attributes for the <link> tag.
     * 
     * @param string $pos The stylesheet position in the stack.
     * 
     * @return self
     * 
     */
    public function addCond($cond, $href, array $attr = null, $pos = 100)
    {
        $attr = $this->fixAttr($href, $attr);
        $link = $this->void('link', $attr);
        $cond  = $this->escaper->html($cond);
        $tag  = "<!--[if $cond]>$link<![endif]-->";
        $this->styles[(int) $pos][] = $tag;

        return $this;
    }

    protected function fixAttr($href, $attr)
    {
        $attr = (array) $attr;
        
        $base = array(
            'rel'   => 'stylesheet',
            'href'  => $href,
            'type'  => 'text/css',
            'media' => 'screen',
        );

        unset($attr['rel']);
        unset($attr['href']);

        return array_merge($base, (array) $attr);
    }
}
