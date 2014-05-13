<?php
namespace Aura\Html;

class EscaperFactory
{
    public function newInstance($encoding = null, $flags = null)
    {
        $html = new Escaper\HtmlEscaper($flags, $encoding);
        $attr = new Escaper\AttrEscaper($html, $encoding);
        $css = new Escaper\CssEscaper($encoding);
        $js = new Escaper\JsEscaper($encoding);
        return new Escaper($html, $attr, $css, $js);
    }
}
