<?php
namespace Aura\Html\Helper\Input;

use Aura\Html\Helper\AbstractHelperTest;

class RadioTest extends AbstractHelperTest
{
    public function test()
    {
        $attribs = array('type' => '', 'name' => 'field', 'value' => '');

        $options = array(
            'foo' => 'bar',
            'baz' => 'dib',
            'zim' => 'gir & doom',
        );

        $radio = $this->helper;

        $actual = $radio(array(
            'name' => 'field',
            'value' => 'baz',
            'attribs' => $attribs,
            'options' => $options,
        ))->__toString();

        $expect = '<label><input type="radio" name="field" value="foo" /> bar</label>' . PHP_EOL
                . '<label><input type="radio" name="field" value="baz" checked /> dib</label>' . PHP_EOL
                . '<label><input type="radio" name="field" value="zim" /> gir &amp; doom</label>' . PHP_EOL;

        $this->assertSame($expect, $actual);
    }

    public function testWithInlineOptionAttribs()
    {
        $radio = $this->helper;

        $actual = $radio(array(
            'name' => 'field',
            'value' => 'baz',
            'options' => array(
                'foo' => array('label' => 'bar',      'attribs' => array('class' => 'opt-foo')),
                'baz' => array('label' => 'dib',      'attribs' => array('data-id' => 2)),
                'zim' => 'gir & doom', // plain string still works
            ),
        ))->__toString();

        $expect = '<label><input type="radio" name="field" value="foo" class="opt-foo" /> bar</label>' . PHP_EOL
                . '<label><input type="radio" name="field" value="baz" data-id="2" checked /> dib</label>' . PHP_EOL
                . '<label><input type="radio" name="field" value="zim" /> gir &amp; doom</label>' . PHP_EOL;

        $this->assertSame($expect, $actual);
    }

    public function testOptionAttribsOverrideGlobal()
    {
        $radio = $this->helper;

        $actual = $radio(array(
            'name'    => 'field',
            'value'   => 'foo',
            'attribs' => array('class' => 'global'),
            'options' => array(
                'foo' => array('label' => 'Foo', 'attribs' => array('class' => 'override')),
                'bar' => 'Bar',
            ),
        ))->__toString();

        $expect = '<label><input type="radio" name="field" class="override" value="foo" checked /> Foo</label>' . PHP_EOL
                . '<label><input type="radio" name="field" class="global" value="bar" /> Bar</label>' . PHP_EOL;

        $this->assertSame($expect, $actual);
    }
}
