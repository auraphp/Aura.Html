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
    protected $styles = [];

    /**
     * 
     * Returns the helper so you can call methods on it.
     * 
     * @return $this
     * 
     */
    public function __invoke()
    {
        return $this;
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
     * @return void
     * 
     */
    public function add($href, array $attr = null, $pos = 100)
    {
        $attr = (array) $attr;
        
        $base = [
            'rel'   => 'stylesheet',
            'href'  => $href,
            'type'  => 'text/css',
            'media' => 'screen',
        ];

        unset($attr['href']);

        $attr = array_merge($base, (array) $attr);
        $tag = $this->void('link', $attr);
        $this->styles[$tag] = $pos;
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
     * @return void
     * 
     */
    public function addCond($cond, $href, array $attr = null, $pos = 100)
    {
        $attr = (array) $attr;
        
        $base = [
            'rel'   => 'stylesheet',
            'href'  => $href,
            'type'  => 'text/css',
            'media' => 'screen',
        ];

        unset($attr['href']);

        $attr = array_merge($base, (array) $attr);
        $link = $this->void('link', $attr);
        $cond  = $this->escaper->html($cond);
        $tag  = "<!--[if $cond]>$link<![endif]-->";
        $this->styles[$tag] = $pos;
    }

    /**
     * 
     * Returns the stack of <link rel="stylesheet" ... /> tags as a single 
     * block.
     * 
     * @return string The <link rel="stylesheet" ... /> tags.
     * 
     */
    public function get()
    {
        asort($this->styles);
        $styles = array_keys($this->styles);
        return $this->indent
             . implode(PHP_EOL . $this->indent, $styles)
             . PHP_EOL;
    }
}
