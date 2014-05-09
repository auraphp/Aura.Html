<?php
namespace Aura\Html;

/**
 * 
 * Based almost entirely on Zend\Escaper by Padraic Brady et al. and modified
 * for conceptual integrity with the rest of Aura.  Some portions copyright
 * (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * under the New BSD License (http://framework.zend.com/license/new-bsd). 
 * 
 */
class EscaperTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->escaper = new Escaper;
    }

    public function test__construct()
    {
        $escaper = new Escaper('iso8859-1', ENT_NOQUOTES);
        $this->assertSame('iso8859-1', $escaper->getEncoding());
        $this->assertSame(ENT_NOQUOTES, $escaper->getFlags());
    }

    public function testSetAndGetEncoding()
    {
        $this->escaper->setEncoding('macroman');
        $this->assertEquals('macroman', $this->escaper->getEncoding());

        $this->setExpectedException('Aura\Html\Exception\EncodingNotSupported');
        $this->escaper->setEncoding('invalid-encoding');
    }

    public function testSetAndGetFlags()
    {
        $this->escaper->setFlags(ENT_NOQUOTES);
        $this->assertSame(ENT_NOQUOTES, $this->escaper->getFlags());
    }

    public function testAttr()
    {
        $chars = array(
            '\''    => '&#x27;',
            '"'     => '&quot;',
            '<'     => '&lt;',
            '>'     => '&gt;',
            '&'     => '&amp;',
            /* Characters beyond ASCII value 255 to unicode escape */
            'Ā'     => '&#x0100;',
            /* Immune chars excluded */
            ','     => ',',
            '.'     => '.',
            '-'     => '-',
            '_'     => '_',
            /* Basic alnums exluded */
            'a'     => 'a',
            'A'     => 'A',
            'z'     => 'z',
            'Z'     => 'Z',
            '0'     => '0',
            '9'     => '9',
            /* Basic control characters and null */
            "\r"    => '&#x0D;',
            "\n"    => '&#x0A;',
            "\t"    => '&#x09;',
            "\0"    => '&#xFFFD;', // should use Unicode replacement char
            /* Encode chars as named entities where possible */
            '<'     => '&lt;',
            '>'     => '&gt;',
            '&'     => '&amp;',
            '"'     => '&quot;',
            /* Encode spaces for quoteless attribute protection */
            ' '     => '&#x20;',
        );

        foreach ($chars as $key => $val) {
            $this->assertEquals(
                $val,
                $this->escaper->attr($key),
                'Failed to escape: ' . $key
            );
        }
    }

    public function testAttr_ranges()
    {
        $immune = array(',', '.', '-', '_'); // Exceptions to escaping ranges
        for ($chr=0; $chr < 0xFF; $chr++) {
            if ($chr >= 0x30 && $chr <= 0x39
                || $chr >= 0x41 && $chr <= 0x5A
                || $chr >= 0x61 && $chr <= 0x7A
            ) {
                $literal = $this->codepointToUtf8($chr);
                $this->assertEquals($literal, $this->escaper->attr($literal));
            } else {
                $literal = $this->codepointToUtf8($chr);
                if (in_array($literal, $immune)) {
                    $this->assertEquals($literal, $this->escaper->attr($literal));
                } else {
                    $this->assertNotEquals(
                        $literal,
                        $this->escaper->attr($literal),
                        $literal . ' should be escaped!'
                    );
                }
            }
        }
    }

    public function testAttr_array()
    {
        $expect = 'foo="bar baz dib"';
        $actual = $this->escaper->attr(array(
            'foo' => array(
                'bar',
                'baz',
                'dib',
            )
        ));
        $this->assertSame($expect, $actual);
    }

    public function testCss()
    {
        $this->assertEquals('', $this->escaper->css(''));
        $this->assertEquals('123', $this->escaper->css('123'));
        
        $chars = array(
            /* HTML special chars - escape without exception to hex */
            '<'     => '\\3C ',
            '>'     => '\\3E ',
            '\''    => '\\27 ',
            '"'     => '\\22 ',
            '&'     => '\\26 ',
            /* Characters beyond ASCII value 255 to unicode escape */
            'Ā'     => '\\100 ',
            /* Immune chars excluded */
            ','     => '\\2C ',
            '.'     => '\\2E ',
            '_'     => '\\5F ',
            /* Basic alnums exluded */
            'a'     => 'a',
            'A'     => 'A',
            'z'     => 'z',
            'Z'     => 'Z',
            '0'     => '0',
            '9'     => '9',
            /* Basic control characters and null */
            "\r"    => '\\D ',
            "\n"    => '\\A ',
            "\t"    => '\\9 ',
            "\0"    => '\\0 ',
            /* Encode spaces for quoteless attribute protection */
            ' '     => '\\20 ',
        );

        foreach ($chars as $key => $val) {
            $this->assertEquals(
                $val,
                $this->escaper->css($key),
                'Failed to escape: ' . $key
            );
        }
    }

    public function testCss_ranges()
    {
        $immune = array(); // CSS has no exceptions to escaping ranges
        for ($chr=0; $chr < 0xFF; $chr++) {
            if ($chr >= 0x30 && $chr <= 0x39
                || $chr >= 0x41 && $chr <= 0x5A
                || $chr >= 0x61 && $chr <= 0x7A
            ) {
                $literal = $this->codepointToUtf8($chr);
                $this->assertEquals($literal, $this->escaper->css($literal));
            } else {
                $literal = $this->codepointToUtf8($chr);
                $this->assertNotEquals(
                    $literal,
                    $this->escaper->css($literal),
                    $literal . ' should be escaped!'
                );
            }
        }
    }
    
    public function testHtml()
    {
        $chars = array(
            '\''    => '&#039;',
            '"'     => '&quot;',
            '<'     => '&lt;',
            '>'     => '&gt;',
            '&'     => '&amp;'
        );

        foreach ($chars as $key => $val) {
            $this->assertEquals(
                $val,
                $this->escaper->html($key),
                'Failed to escape: ' . $key
            );
        }
    }

    public function testJs()
    {
        $this->assertEquals('', $this->escaper->js(''));
        $this->assertEquals('123', $this->escaper->js('123'));
        
        $chars = array(
            /* HTML special chars - escape without exception to hex */
            '<'     => '\\x3C',
            '>'     => '\\x3E',
            '\''    => '\\x27',
            '"'     => '\\x22',
            '&'     => '\\x26',
            /* Characters beyond ASCII value 255 to unicode escape */
            'Ā'     => '\\u0100',
            /* Immune chars excluded */
            ','     => ',',
            '.'     => '.',
            '_'     => '_',
            /* Basic alnums exluded */
            'a'     => 'a',
            'A'     => 'A',
            'z'     => 'z',
            'Z'     => 'Z',
            '0'     => '0',
            '9'     => '9',
            /* Basic control characters and null */
            "\r"    => '\\x0D',
            "\n"    => '\\x0A',
            "\t"    => '\\x09',
            "\0"    => '\\x00',
            /* Encode spaces for quoteless attribute protection */
            ' '     => '\\x20',
        );

        foreach ($chars as $key => $val) {
            $this->assertEquals(
                $val,
                $this->escaper->js($key),
                'Failed to escape: ' . $key
            );
        }
    }

    public function testJs_ranges()
    {
        $immune = array(',', '.', '_'); // Exceptions to escaping ranges
        for ($chr=0; $chr < 0xFF; $chr++) {
            if ($chr >= 0x30 && $chr <= 0x39
                || $chr >= 0x41 && $chr <= 0x5A
                || $chr >= 0x61 && $chr <= 0x7A
            ) {
                $literal = $this->codepointToUtf8($chr);
                $this->assertEquals($literal, $this->escaper->js($literal));
            } else {
                $literal = $this->codepointToUtf8($chr);
                if (in_array($literal, $immune)) {
                    $this->assertEquals($literal, $this->escaper->js($literal));
                } else {
                    $this->assertNotEquals(
                        $literal,
                        $this->escaper->js($literal),
                        $literal . ' should be escaped!'
                    );
                }
            }
        }
    }

    public function testToUtf8()
    {
        $this->escaper->setEncoding('iso8859-1');
        $this->assertSame('', $this->escaper->toUtf8(''));
        $this->assertSame('foo', $this->escaper->toUtf8('foo'));
    }

    public function testToUtf8_invalid()
    {
        // http://stackoverflow.com/questions/11709410/regex-to-detect-invalid-utf-8-string
        $this->setExpectedException('Aura\Html\Exception\InvalidUtf8');
        $this->escaper->toUtf8(chr(0xC0) . chr(0x80));
    }

    public function testFromUtf8()
    {
        $this->escaper->setEncoding('iso8859-1');
        $this->assertSame('', $this->escaper->fromUtf8(''));
        $this->assertSame('foo', $this->escaper->fromUtf8('foo'));
    }

    /**
     * Range tests to confirm escaped range of characters is within OWASP recommendation
     */

    /**
     * Only testing the first few 2 ranges on this prot. function as that's all these
     * other range tests require
     */
    public function testUnicodeCodepointConversionToUtf8()
    {
        $expected = " ~ޙ";
        $codepoints = array(0x20, 0x7e, 0x799);
        $result = '';
        foreach ($codepoints as $value) {
            $result .= $this->codepointToUtf8($value);
        }
        $this->assertEquals($expected, $result);
    }

    /**
     * 
     * Convert a Unicode Codepoint to a literal UTF-8 character.
     *
     * @param int Unicode codepoint in hex notation
     * 
     * @return string UTF-8 literal string
     * 
     */
    protected function codepointToUtf8($codepoint)
    {
        if ($codepoint < 0x80) {
            return chr($codepoint);
        }
        if ($codepoint < 0x800) {
            return chr($codepoint >> 6 & 0x3f | 0xc0)
                 . chr($codepoint & 0x3f | 0x80);
        }
        if ($codepoint < 0x10000) {
            return chr($codepoint >> 12 & 0x0f | 0xe0)
                 . chr($codepoint >> 6 & 0x3f | 0x80)
                 . chr($codepoint & 0x3f | 0x80);
        }
        if ($codepoint < 0x110000) {
            return chr($codepoint >> 18 & 0x07 | 0xf0)
                 . chr($codepoint >> 12 & 0x3f | 0x80)
                 . chr($codepoint >> 6 & 0x3f | 0x80)
                 . chr($codepoint & 0x3f | 0x80);
        }
        throw new \Exception('Codepoint requested outside of Unicode range');
    }
}
