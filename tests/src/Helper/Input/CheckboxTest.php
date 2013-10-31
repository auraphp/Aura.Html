<?php
namespace Aura\Html\Helper\Input;

use Aura\Html\Helper\AbstractHelperTest;

class CheckboxTest extends AbstractHelperTest
{
    public function testChecked()
    {
        $checkbox = $this->helper;
        $actual = $checkbox(array(
            'value' => 'yes',
            'attribs' => array(
                'value' => 'yes',
                'label' => 'This is yes',
            )
        ));
        $expect = '<label><input type="checkbox" value="yes" checked /> This is yes</label>' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }
    
    public function testUnchecked()
    {
        $checkbox = $this->helper;
        $actual = $checkbox(array(
            'value' => 'no',
            'attribs' => array(
                'value' => 'yes',
                'label' => 'This is yes',
            )
        ));
        $expect = '<label><input type="checkbox" value="yes" /> This is yes</label>' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }
    
    public function testCheckedWithUncheckedValue()
    {
        $checkbox = $this->helper;
        $actual = $checkbox(array(
            'value' => 'yes',
            'attribs' => array(
                'value' => 'yes',
                'value_unchecked' => 'no',
                'label' => 'This is yes',
            ),
        ));
        $expect = '<label><input type="hidden" value="no" /><input type="checkbox" value="yes" checked /> This is yes</label>' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }
    
    public function testUncheckedWithUncheckedValue()
    {
        $checkbox = $this->helper;
        $actual = $checkbox(array(
            'value' => 'no',
            'attribs' => array(
                'label' => 'This is yes',
                'value' => 'yes',
                'value_unchecked' => 'no',
            ),
        ));
        $expect = '<label><input type="hidden" value="no" /><input type="checkbox" value="yes" /> This is yes</label>' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }
    
    public function testNoLabel()
    {
        $checkbox = $this->helper;
        $actual = $checkbox(array(
            'value' => 'no',
            'attribs' => array(
                'value' => 'yes',
            ),
        ));
        $expect = '<input type="checkbox" value="yes" />' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }
    
    public function testLabelWithFor()
    {
        $checkbox = $this->helper;
        $actual = $checkbox(array(
            'value' => 'no',
            'attribs' => array(
                'id' => 'input-yes',
                'value' => 'yes',
                'label' => 'This is yes'
            )
        ));
        
        $expect = '<label for="input-yes"><input id="input-yes" type="checkbox" value="yes" /> This is yes</label>' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }
}
