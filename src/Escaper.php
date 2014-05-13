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
namespace Aura\Html;

use Aura\Html\Escaper\HtmlEscaper;
use Aura\Html\Escaper\AttrEscaper;
use Aura\Html\Escaper\CssEscaper;
use Aura\Html\Escaper\JsEscaper;

class Escaper
{
    static protected $escaper;
    
    protected $html;
    protected $attr;
    protected $css;
    protected $js;

    /**
     * 
     * Constructor.
     *
     * @param string $encoding The encoding for raw and escaped strings.
     * 
     * @param mixed $flags Flags for `htmlspecialchars()`.
     * 
     */
    public function __construct(
        HtmlEscaper $html,
        AttrEscaper $attr,
        CssEscaper $css,
        JsEscaper $js
    ) {
        $this->html = $html;
        $this->attr = $attr;
        $this->css = $css;
        $this->js = $js;
    }

    /**
     * 
     * Escapes for unquoted HTML attribute context.
     *
     * @param string $raw The raw string.
     * 
     * @return string The escaped string.
     * 
     */
    public function attr($raw)
    {
        return $this->attr->__invoke($raw);
    }

    /**
     * 
     * Escapes for HTML body and quoted HTML attribute context.
     *
     * @param string $raw The raw string.
     * 
     * @return string The escaped string.
     * 
     */
    public function html($raw)
    {
        return $this->html->__invoke($raw);
    }

    /**
     * 
     * Escapes for CSS context.
     *
     * @param string $raw The raw string.
     * 
     * @return string The escaped string.
     * 
     */
    public function css($raw)
    {
        return $this->css->__invoke($raw);
    }

    /**
     * 
     * Escapes for JavaScript context.
     *
     * @param string $raw The raw string.
     * 
     * @return string The escaped string.
     * 
     */
    public function js($raw)
    {
        return $this->js->__invoke($raw);
    }

    public function setEncoding($encoding)
    {
        $this->html->setEncoding($encoding);
        $this->attr->setEncoding($encoding);
        $this->css->setEncoding($encoding);
        $this->js->setEncoding($encoding);
    }

    public function setFlags($flags)
    {
        $this->html->setFlags($flags);
    }

    public function getHtml()
    {
        return $this->html;
    }

    public function getAttr()
    {
        return $this->attr;
    }

    public function getCss()
    {
        return $this->css;
    }

    public function getJs()
    {
        return $this->js;
    }

    public static function setStatic(Escaper $escaper)
    {
        static::$escaper = $escaper;
    }

    public static function getStatic()
    {
        return static::$escaper;
    }
    
    public static function a($raw)
    {
        return static::$escaper->attr($raw);
    }

    public static function h($raw)
    {
        return static::$escaper->html($raw);
    }
    
    public static function c($raw)
    {
        return static::$escaper->css($raw);
    }
    
    public static function j($raw)
    {
        return static::$escaper->js($raw);
    }
}
