<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 *
 */
namespace Aura\Html;

/**
 *
 * A ServiceLocator implementation for loading and retaining helper objects.
 *
 * @package Aura.Html
 *
 * @method string a($href, $text, array $attr = [])
 * @method string anchor($href, $text, array $attr = [])
 * @method string aRaw($href, $text, array $attr = [])
 * @method string anchorRaw($href, $text, array $attr = [])
 * @method string base($href)
 * @method Escaper escape()
 * @method string element($tag, array $attr = [], $text = null)
 * @method string ele($tag, array $attr = [], $text = null)
 * @method string elementRaw($tag, array $attr = [], $text = null)
 * @method string eleRaw($tag, array $attr = [], $text = null)
 * @method string img($src, array $attr = [])
 * @method string image($src, array $attr = [])
 * @method Helper\Form form(array $attr = [])
 * @method Helper\Input input(array $spec)
 * @method string label($text = null, array $attr = [])
 * @method Helper\Links links()
 * @method Helper\Metas metas()
 * @method Helper\Ol ol(array $attr = [])
 * @method Helper\Scripts scripts()
 * @method Helper\Scripts scriptsFoot()
 * @method Helper\Styles styles()
 * @method Helper\Structure structure($tag = null, array $attr = [])
 * @method Helper\Structure structureRaw($tag = null, array $attr = [])
 * @method Helper\Structure struct($tag = null, array $attr = [])
 * @method Helper\Structure structRaw($tag = null, array $attr = [])
 * @method string tag($tag, array $attr = [])
 * @method Helper\Title title($text = null)
 * @method Helper\Ul ul(array $attr = [])
 * @method string void($tag, array $attr = [])
 *
 */
class HelperLocator
{
    /**
     *
     * A map of helper factories.
     *
     * @var array
     *
     */
    protected $map = array();

    /**
     *
     * The helper object instances.
     *
     * @var array
     *
     */
    protected $helpers = array();

    /**
     *
     * Constructor.
     *
     * @param array $map An array of key-value pairs where the key is the
     * helper name and the value is a callable that returns a helper object.
     *
     */
    public function __construct(array $map = array())
    {
        $this->map = $map;
    }

    /**
     *
     * Magic call to make the helper objects available as methods.
     *
     * @param string $name A helper name.
     *
     * @param array $args Arguments to pass to the helper.
     *
     * @return mixed
     *
     */
    public function __call($name, $args)
    {
        return call_user_func_array(
            $this->get($name),
            $args
        );
    }

    /**
     *
     * Sets a helper object factory into the map.
     *
     * @param string $name The helper name.
     *
     * @param callable $callable A callable to create the helper object.
     *
     * @return void
     *
     */
    public function set($name, $callable)
    {
        $this->map[$name] = $callable;
        unset($this->helpers[$name]);
    }

    /**
     *
     * Does a named helper exist in the locator?
     *
     * @param string $name The helper name.
     *
     * @return bool
     *
     */
    public function has($name)
    {
        return isset($this->map[$name]);
    }

    /**
     *
     * Returns a helper object instance, using the map to factory it if needed.
     *
     * @param string $name The helper to retrieve.
     *
     * @return object
     *
     */
    public function get($name)
    {
        if (! $this->has($name)) {
            throw new Exception\HelperNotFound($name);
        }

        if (! isset($this->helpers[$name])) {
            $factory = $this->map[$name];
            $this->helpers[$name] = $factory();
        }

        return $this->helpers[$name];
    }
}
