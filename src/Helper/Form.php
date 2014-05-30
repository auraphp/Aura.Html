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
 * Helper to generate an opening form tag.
 *
 * @package Aura.Html
 *
 */
class Form extends AbstractHelper
{
    /**
     *
     * Returns any kind of tag with attributes.
     *
     * @param string $tag The tag to generate.
     *
     * @param array $attr Attributes for the tag.
     *
     * @return string
     *
     */
    public function __invoke(array $attr = array())
    {
        $base = array(
            'id' => null,
            'method' => 'post',
            'action' => null,
            'enctype' => 'multipart/form-data',
        );

        $attr = $this->escaper->attr(array_merge($base, $attr));
        return "<form $attr>";
    }
}
