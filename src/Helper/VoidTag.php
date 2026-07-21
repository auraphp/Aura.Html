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
 * Helper to generate any void tag.
 *
 * @package Aura.Html
 *
 */
class VoidTag extends AbstractHelper
{
    /**
     *
     * Returns any kind of void tag with attributes.
     *
     * @param string $tag The tag to generate.
     *
     * @param array $attr Attributes for the tag.
     *
     * @return string
     *
     */
    public function __invoke($tag, array $attr = array())
    {
        return $this->void($tag, $attr);
    }
}
