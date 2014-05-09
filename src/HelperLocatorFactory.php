<?php
namespace Aura\Html;

use Aura\Html\Helper;

class HelperLocatorFactory
{
    protected $escaper;

    public function __construct($encoding = null, $flags = null)
    {
        $this->escaper = new Escaper($encoding, $flags);
        Escaper::setStatic($this->escaper);
    }

    public function newInstance()
    {
        $escaper = $this->escaper;
        $input = $this->newInputInstance();
        return new HelperLocator(array(
            'a'                 => function () use ($escaper) { return new Helper\Anchor($escaper); },
            'anchor'            => function () use ($escaper) { return new Helper\Anchor($escaper); },
            'base'              => function () use ($escaper) { return new Helper\Base($escaper); },
            'form'              => function () use ($escaper) { return new Helper\Form($escaper); },
            'img'               => function () use ($escaper) { return new Helper\Img($escaper); },
            'image'             => function () use ($escaper) { return new Helper\Img($escaper); },
            'input'             => function () use ($input)   { return $input; },
            'links'             => function () use ($escaper) { return new Helper\Links($escaper); },
            'metas'             => function () use ($escaper) { return new Helper\Metas($escaper); },
            'ol'                => function () use ($escaper) { return new Helper\Ol($escaper); },
            'scripts'           => function () use ($escaper) { return new Helper\Scripts($escaper); },
            'scriptsFoot'       => function () use ($escaper) { return new Helper\Scripts($escaper); },
            'styles'            => function () use ($escaper) { return new Helper\Styles($escaper); },
            'tag'               => function () use ($escaper) { return new Helper\Tag($escaper); },
            'title'             => function () use ($escaper) { return new Helper\Title($escaper); },
            'ul'                => function () use ($escaper) { return new Helper\Ul($escaper); },
        ));
    }

    public function newInputInstance()
    {
        $escaper = $this->escaper;
        return new Helper\Input(new HelperLocator(array(
            'button'            => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'checkbox'          => function () use ($escaper) { return new Helper\Input\Checkbox($escaper); },
            'color'             => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'date'              => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'datetime'          => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'datetime-local'    => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'email'             => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'file'              => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'hidden'            => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'image'             => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'month'             => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'number'            => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'password'          => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'radio'             => function () use ($escaper) { return new Helper\Input\Radio($escaper); },
            'range'             => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'reset'             => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'search'            => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'select'            => function () use ($escaper) { return new Helper\Input\Select($escaper); },
            'submit'            => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'tel'               => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'text'              => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'textarea'          => function () use ($escaper) { return new Helper\Input\Textarea($escaper); },
            'time'              => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'url'               => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
            'week'              => function () use ($escaper) { return new Helper\Input\Generic($escaper); },
        )));
    }
}
