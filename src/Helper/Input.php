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

use Aura\Html\AbstractHelperLocator;

/**
 *
 * A helper to generate form input elements.
 *
 * @package Aura.Html
 *
 */
class Input
{
    /**
     *
     * A locator for input elements.
     *
     * @var HelperLocator
     *
     */
    protected $helper_locator;

    /**
     *
     * Constructor.
     *
     * @param HelperLocator $helper_locator A locator for input helpers.
     *
     */
    public function __construct(AbstractHelperLocator $helper_locator)
    {
        $this->helper_locator = $helper_locator;
    }

    /**
     *
     * Given an input specification, returns the HTML for the input.
     *
     * @param array $spec The element specification.
     *
     * @return string
     *
     */
    public function __invoke(array $spec = null)
    {
        if ($spec === null) {
            return $this;
        }

        if (empty($spec['type'])) {
            $spec['type'] = 'text';
        }

        if (empty($spec['attribs']['name'])) {
            $spec['attribs']['name'] = $spec['name'];
        }

        $input = $this->helper_locator->get($spec['type']);
        return $input($spec);
    }
}
