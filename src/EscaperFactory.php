<?php
namespace Aura\Html;

use Aura\Html\Escaper;
use Aura\Html\Escaper\HtmlEscaper;
use Aura\Html\Escaper\AttrEscaper;
use Aura\Html\Escaper\CssEscaper;
use Aura\Html\Escaper\JsEscaper;

class EscaperFactory
{
    public function newInstance($encoding = null, $flags = null)
    {
        $html = new HtmlEscaper($flags, $encoding);
        $attr = new AttrEscaper($html, $encoding);
        $css = new CssEscaper($encoding);
        $js = new JsEscaper($encoding);
        return new Escaper($html, $attr, $css, $js);
    }
}
