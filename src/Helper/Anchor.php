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
 * Helper to generate `<a ... />` tags.
 *
 * @package Aura.Html
 *
 */
class Anchor extends AbstractHelper
{
    /**
     *
     * Returns an anchor tag.
     *
     * @param string $href The anchor href specification.
     *
     * @param string $text The text for the anchor (optional. default: $href).
     *
     * @param array $attr Attributes for the anchor.
     *
     * @param boolean $escape Set to false for raw text (default:true)
     *
     * @return string
     *
     */
    public function __invoke($href, $text = null, array $attr = array(), $escape = true)
    {
        if (null === $text) {
            $text = $href;
        }

        $base = array(
            'href' => $href,
        );

        unset($attr['href']);

        $attr = $this->escaper->attr(array_merge($base, $attr));

        if ($escape) {
            $text = $this->escaper->html($text);
        }

        return "<a $attr>$text</a>";
    }
}
