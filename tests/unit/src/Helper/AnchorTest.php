<?php
namespace Aura\Html\Helper;

class AnchorTest extends AbstractHelperTest
{
    public function test__invoke()
    {
        $data = (object) array(
            'href' => '/path/to/script.php',
            'text' => 'this',
        );

        $anchor = $this->helper;
        $actual = $anchor($data->href, $data->text);
        $expect = '<a href="/path/to/script.php">this</a>';
        $this->assertSame($expect, $actual);
    }

    public function testWithAttribs()
    {
        $data = (object) array(
            'href' => '/path/to/script.php',
            'text' => 'foo',
            'attribs' => array('bar' => 'baz', 'href' => 'skip-me'),
        );

        $anchor = $this->helper;
        $actual = $anchor($data->href, $data->text, $data->attribs);
        $expect = '<a href="/path/to/script.php" bar="baz">foo</a>';
        $this->assertSame($expect, $actual);
    }

    public function testRawText()
    {
        $data = (object) array(
            'href' => '/path/to/script.php',
            'text' => '<span>HTML</span>',
            'attribs' => array(),
            'escape' => false
        );

        $anchor = $this->helper;
        $actual = $anchor($data->href, $data->text, $data->attribs, $data->escape);
        $expect = '<a href="/path/to/script.php"><span>HTML</span></a>';
        $this->assertSame($expect, $actual);
    }

    public function testHrefOnly()
    {
        $data = (object) array(
            'href' => '/path/to/script.php',
        );

        $anchor = $this->helper;
        $actual = $anchor($data->href);
        $expect = '<a href="/path/to/script.php">/path/to/script.php</a>';
        $this->assertSame($expect, $actual);
    }
}
