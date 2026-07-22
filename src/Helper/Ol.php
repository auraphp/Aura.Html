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
 * Helper for `<ol>` tag with `<li>` items.
 *
 * @package Aura.Html
 *
 */
class Ol extends AbstractList
{
    /**
     *
     * Returns the tag name.
     *
     * @return string
     *
     */
    protected function getTag()
    {
        return 'ol';
    }
}
