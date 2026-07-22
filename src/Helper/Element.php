<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @license http://opensource.org/licenses/MIT-license.php MIT
 *
 */
namespace Aura\Html\Helper;

/**
 *
 * Helper to generate a complete element.
 *
 * @package Aura.Html
 *
 */
class Element extends AbstractElement
{
    /**
     *
     * Returns any kind of complete HTML element with attributes.
     *
     * @param string $tag The tag to generate.
     *
     * @param string $content The element content
     *
     * @param array $attr Attributes for the tag.
     *
     * @return string
     *
     */
    public function __invoke($tag, $content, array $attr = array())
    {
        return $this->escaped($tag, $content, $attr);
    }
}
