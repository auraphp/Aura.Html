<?php
namespace Aura\Html\_Config;

use Aura\Di\Config;
use Aura\Di\Container;
use Aura\Html\Functions\EscaperFunctions;

class Common extends Config
{
    public function define(Container $di)
    {
        /**
         * Services
         */
        $di->set('html_escaper', $di->lazy(array(
            $di->lazyNew('Aura\Html\EscaperFactory'),
            'newInstance'
        )));
        $di->set('html_helper', $di->lazyNew('Aura\Html\HelperLocator'));

        /**
         * Aura\Html\HelperLocator
         */
        $di->params['Aura\Html\HelperLocator']['map'] = array(
            'a'                 => $di->lazyNew('Aura\Html\Helper\Anchor'),
            'anchor'            => $di->lazyNew('Aura\Html\Helper\Anchor'),
            'base'              => $di->lazyNew('Aura\Html\Helper\Base'),
            'escape'            => $di->lazyGet('html_escaper'),
            'form'              => $di->lazyNew('Aura\Html\Helper\Form'),
            'img'               => $di->lazyNew('Aura\Html\Helper\Img'),
            'image'             => $di->lazyNew('Aura\Html\Helper\Img'),
            'input'             => $di->lazyNew('Aura\Html\Helper\Input'),
            'label'             => $di->lazyNew('Aura\Html\Helper\Label'),
            'links'             => $di->lazyNew('Aura\Html\Helper\Links'),
            'metas'             => $di->lazyNew('Aura\Html\Helper\Metas'),
            'ol'                => $di->lazyNew('Aura\Html\Helper\Ol'),
            'scripts'           => $di->lazyNew('Aura\Html\Helper\Scripts'),
            'scriptsFoot'       => $di->lazyNew('Aura\Html\Helper\Scripts'),
            'styles'            => $di->lazyNew('Aura\Html\Helper\Styles'),
            'tag'               => $di->lazyNew('Aura\Html\Helper\Tag'),
            'title'             => $di->lazyNew('Aura\Html\Helper\Title'),
            'ul'                => $di->lazyNew('Aura\Html\Helper\Ul'),
        );

        /**
         * Aura\Html\Helper\AbstractHelper
         */
        $di->params['Aura\Html\Helper\AbstractHelper']['escaper'] = $di->lazyGet('html_escaper');

        /**
         * Aura\Html\Helper\Input
         */
        $di->params['Aura\Html\Helper\Input']['map'] = array(
            'button'            => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'checkbox'          => $di->lazyNew('Aura\Html\Helper\Input\Checkbox'),
            'color'             => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'date'              => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'datetime'          => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'datetime-local'    => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'email'             => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'file'              => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'hidden'            => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'image'             => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'month'             => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'number'            => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'password'          => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'radio'             => $di->lazyNew('Aura\Html\Helper\Input\Radio'),
            'range'             => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'reset'             => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'search'            => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'select'            => $di->lazyNew('Aura\Html\Helper\Input\Select'),
            'submit'            => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'tel'               => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'text'              => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'textarea'          => $di->lazyNew('Aura\Html\Helper\Input\Textarea'),
            'time'              => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'url'               => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
            'week'              => $di->lazyNew('Aura\Html\Helper\Input\Generic'),
        );
    }

    public function modify(Container $di)
    {
        \Aura\Html\Escaper::setStatic($di->get('html_escaper'));
    }
}
