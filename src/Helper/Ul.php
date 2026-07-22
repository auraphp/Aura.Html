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
 * Helper for `<ul>` tag with `<li>` items.
 *
 * @package Aura.Html
 *
 */
class Ul extends AbstractList
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
        return 'ul';
    }
}
