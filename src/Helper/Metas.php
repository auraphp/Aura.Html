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
 * Helper for a stack of <meta ... /> tags.
 * 
 * @package Aura.Html
 * 
 */
class Metas extends AbstractHelper
{
    /**
     * 
     * The array of all metas added to the helper.
     * 
     * @var array
     * 
     */
    protected $metas = [];

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
     * Returns a `<meta ...>` tag.
     * 
     * @param array $attr Attributes for the <link> tag.
     * 
     * @param int $pos The meta position.
     * 
     * @return void
     * 
     */
    public function add(array $attr = [], $pos = 100)
    {
        $this->metas[(int) $pos][] = $this->void('meta', $attr);
    }

    /**
     * 
     * Returns a `<meta http-equiv="" content="">` tag.
     * 
     * @param string $http_equiv The http-equiv type.
     * 
     * @param string $content The content value.
     * 
     * @param int $pos The meta position.
     * 
     * @return void
     * 
     */
    public function addHttp($http_equiv, $content, $pos = 100)
    {
        $attr = [
            'http-equiv' => $http_equiv,
            'content'    => $content,
        ];

        $this->add($attr, $pos);
    }

    /**
     * 
     * Returns a `<meta name="" content="">` tag.
     * 
     * @param string $name The name value.
     * 
     * @param string $content The content value.
     * 
     * @param int $pos The meta position.
     * 
     * @return void
     * 
     */
    public function addName($name, $content, $pos = 100)
    {
        $attr = [
            'name'    => $name,
            'content' => $content,
        ];

        $this->add($attr, $pos);
    }

    /**
     * 
     * Returns the stack of `<meta ...>` tags as a single block.
     * 
     * @return string The `<meta ...>` tags.
     * 
     */
    public function get()
    {
        $html = '';
        ksort($this->metas);
        foreach ($this->metas as $list) {
            foreach ($list as $meta) {
                $html .= $this->indent(1, $meta);
            }
        }
        return $html;
    }
}
