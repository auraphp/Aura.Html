<?php
namespace Aura\Html\Helper;

class LabelTest extends AbstractHelperTest
{
    public function test__invoke()
    {
        $label = $this->helper;
        $actual = $label('Foo');
        $expect = '<label>Foo</label>';
        $this->assertSame($actual, $expect);
    }
    
    public function testWithAttr()
    {
        $label = $this->helper;
        $attr = array(
            'for'=>'bar',
            'class'=>'dim'
        );
        $actual = $label('Foo', $attr);
        $expect = '<label for="bar" class="dim">Foo</label>';
        $this->assertSame($actual, $expect);
    }
    
    public function testWithInput()
    {
        $label = $this->helper;
        $attr = array(
            'for'=>'bar',
        );
        $input = '<input type="checkbox" name="cbox" id="bar" />';
        $actual = $label('Foo', $attr, $input);
        $expect = '<label for="bar">' . PHP_EOL 
                . '    <input type="checkbox" name="cbox" id="bar" />Foo' . PHP_EOL
                . '</label>' . PHP_EOL;
        $this->assertSame($actual, $expect);
    }
}
