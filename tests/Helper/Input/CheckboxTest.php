<?php
namespace Aura\Html\Helper\Input;

use Aura\Html\Exception\InvalidArgument;
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
                'label' => 'This & yes',
            )
        ))->__toString();
        $expect = '<label><input type="checkbox" value="yes" checked /> This &amp; yes</label>' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }

    public function testUnchecked()
    {
        $checkbox = $this->helper;
        $actual = $checkbox(array(
            'value' => 'no',
            'attribs' => array(
                'value' => 'yes',
                'label' => 'This & yes',
            )
        ))->__toString();
        $expect = '<label><input type="checkbox" value="yes" /> This &amp; yes</label>' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }

    public function testCheckedWithUncheckedValue()
    {
        $checkbox = $this->helper;
        $actual = $checkbox(array(
            'name'=>'foo',
            'value' => 'yes',
            'attribs' => array(
                'value' => 'yes',
                'value_unchecked' => 'no',
                'label' => 'This & yes',
            ),
        ))->__toString();
        $expect = '<input type="hidden" value="no" name="foo" /><label><input type="checkbox" name="foo" value="yes" checked /> This &amp; yes</label>' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }

    public function testUncheckedWithUncheckedValue()
    {
        $checkbox = $this->helper;
        $actual = $checkbox(array(
            'value' => 'no',
            'name'=>'foo',
            'attribs' => array(
                'label' => 'This & yes',
                'value' => 'yes',
                'value_unchecked' => 'no',
            ),
        ))->__toString();
        $expect = '<input type="hidden" value="no" name="foo" /><label><input type="checkbox" name="foo" value="yes" /> This &amp; yes</label>' . PHP_EOL;
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
        ))->__toString();
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
                'label' => 'This & yes'
            )
        ))->__toString();

        $expect = '<label for="input-yes"><input id="input-yes" type="checkbox" value="yes" /> This &amp; yes</label>' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }

    public function testNoValueAttrib()
    {
        $checkbox = $this->helper;
        $actual = $checkbox(array(
            'value' => 'no',
        ))->__toString();
        $expect = '<input type="checkbox" />' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }

    public function testStrict()
    {
        $checkbox = $this->helper;
        $checkbox->strict();

        $actual = $checkbox(array(
            'value' => 1, // INTEGER
            'attribs' => array(
                'value' => '1',
            )
        ))->__toString();
        $expect = '<input type="checkbox" value="1" />' . PHP_EOL;
        $this->assertSame($expect, $actual);

        $checkbox = $this->helper;
        $actual = $checkbox(array(
            'value' => '1', // STRING
            'attribs' => array(
                'value' => '1',
            )
        ))->__toString();
        $expect = '<input type="checkbox" value="1" checked />' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }

    public function testMultiCheckbox() {
        $checkbox = $this->helper;
        $actual = $checkbox(array(
            'name' => 'foo',
            'value' => 'yes',
            'options' => array(
                'yes' => 'Yes',
                'no' => 'No',
                'maybe' => 'Maybe'
            ),
            'attribs' => array(
                'value' => 'yes',
                'label' => 'Is ignored',
            )
        ))->__toString();
        $expect = '<label><input type="checkbox" name="foo[]" value="yes" checked /> Yes</label>' . PHP_EOL
                . '<label><input type="checkbox" name="foo[]" value="no" /> No</label>' . PHP_EOL
                . '<label><input type="checkbox" name="foo[]" value="maybe" /> Maybe</label>' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }

    public function testMultiCheckboxWithValues() {
        $checkbox = $this->helper;
        $actual = $checkbox(array(
            'name' => 'foo',
            'value' => array('yes', 'no'),
            'options' => array(
                'yes' => 'Yes',
                'no' => 'No',
                'maybe' => 'Maybe'
            ),
            'attribs' => array(
                'value' => 'yes',
                'label' => 'Is ignored',
            )
        ))->__toString();
        $expect = '<label><input type="checkbox" name="foo[]" value="yes" checked /> Yes</label>' . PHP_EOL
            . '<label><input type="checkbox" name="foo[]" value="no" checked /> No</label>' . PHP_EOL
            . '<label><input type="checkbox" name="foo[]" value="maybe" /> Maybe</label>' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }

    public function testMultiCheckboxWithInlineOptionAttribs()
    {
        $checkbox = $this->helper;
        $actual = $checkbox(array(
            'name' => 'foo',
            'value' => 'yes',
            'options' => array(
                'yes' => array('label' => 'Yes', 'attribs' => array('class' => 'test-class')),
                'no'  => array('label' => 'No',  'attribs' => array('data-no' => 1)),
                'maybe' => 'Maybe', // plain string still works
            ),
        ))->__toString();
        $expect = '<label><input type="checkbox" name="foo[]" value="yes" class="test-class" checked /> Yes</label>' . PHP_EOL
            . '<label><input type="checkbox" name="foo[]" value="no" data-no="1" /> No</label>' . PHP_EOL
            . '<label><input type="checkbox" name="foo[]" value="maybe" /> Maybe</label>' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }

    public function testMultiCheckboxOptionAttribsOverrideGlobal()
    {
        $checkbox = $this->helper;
        $actual = $checkbox(array(
            'name' => 'foo',
            'value' => 'yes',
            'attribs' => array('class' => 'global'),
            'options' => array(
                'yes' => array('label' => 'Yes', 'attribs' => array('class' => 'override')),
                'no'  => 'No',
            ),
        ))->__toString();
        $expect = '<label><input type="checkbox" name="foo[]" class="override" value="yes" checked /> Yes</label>' . PHP_EOL
            . '<label><input type="checkbox" name="foo[]" class="global" value="no" /> No</label>' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }

    public function testMultiCheckboxOptionAttribsResetBetweenCalls()
    {
        $checkbox = $this->helper;

        // First call with per-option attribs
        $checkbox(array(
            'name' => 'foo',
            'value' => 'yes',
            'options' => array(
                'yes' => array('label' => 'Yes', 'attribs' => array('class' => 'first')),
            ),
        ))->__toString();

        // Second call without per-option attribs — no bleed-through
        $actual = $checkbox(array(
            'name' => 'foo',
            'value' => 'yes',
            'options' => array(
                'yes' => 'Yes',
            ),
        ))->__toString();
        $expect = '<label><input type="checkbox" name="foo[]" value="yes" checked /> Yes</label>' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }

    public function testInvalidOptionAttribsThrows()
    {
        $this->expectException(InvalidArgument::class);
        $this->expectExceptionMessage("Option 'attribs' must be an array for option 'yes'.");

        $checkbox = $this->helper;
        $checkbox(array(
            'name'  => 'foo',
            'value' => 'yes',
            'options' => array(
                'yes' => array('label' => 'Yes', 'attribs' => 'not-an-array'),
            ),
        ))->__toString();
    }
}
