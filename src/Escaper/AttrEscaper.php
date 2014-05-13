<?php
namespace Aura\Html\Escaper;

use Aura\Html\Exeption;

class AttrEscaper extends AbstractEscaper
{
    /**
     * 
     * HTML entities mapped from ord() values.
     * 
     * @var array
     * 
     */
    protected $entities = array(
        34 => '&quot;',
        38 => '&amp;',
        60 => '&lt;',
        62 => '&gt;',
    );

    protected $html;

    public function __construct($html, $encoding = null)
    {
        $this->html = $html;
        parent::__construct($encoding);
    }
    
    public function __invoke($raw)
    {
        if (is_array($raw)) {
            return $this->attrArray($raw);
        }
        
        return $this->replace(
            $raw,
            '/[^a-z0-9,\.\-_]/iSu'
        );
    }

    /**
     * 
     * Converts an associative array to an attribute string.
     * 
     * Keys are attribute names, and values are attribute values. A value
     * of boolean true indicates a minimized attribute; for example,
     * `['disabled' => 'disabled']` results in `disabled="disabled"`, but
     * `['disabled' => true]` results in `disabled`.  Values of `false` or
     * `null` will omit the attribute from output.  Array values will be
     * concatenated and space-separated before escaping.
     * 
     * @param array $raw An array of key-value pairs where the key is the
     * attribute name and the value is the attribute value.
     * 
     * @return string The attribute array converted to a properly-escaped
     * string.
     * 
     */
    protected function attrArray(array $raw)
    {
        $esc = '';
        foreach ($raw as $key => $val) {

            // do not add null and false values
            if ($val === null || $val === false) {
                continue;
            }
            
            // get rid of extra spaces in the key
            $key = trim($key);
            
            // concatenate and space-separate multiple values
            if (is_array($val)) {
                $val = implode(' ', $val);
            }
            
            // what kind of attribute representation?
            if ($val === true) {
                // minimized
                $esc .= $this->__invoke($key);
            } else {
                // full; because the it is quoted, we can use html ecaping
                $esc .= $this->__invoke($key) . '="'
                      . $this->html->__invoke($val) . '"';
            }
            
            // space separator
            $esc .= ' ';
        }

        // done; remove the last space
        return rtrim($esc);
    }
    
    /**
     * 
     * Replaces unsafe HTML attribute characters.
     *
     * @param array $matches Matches from preg_replace_callback().
     * 
     * @return string Escaped characters.
     * 
     */
    protected function replaceMatches($matches)
    {
        $chr = $matches[0];

        if ($this->charIsUndefinedInHtml($chr)) {
            // use the Unicode replacement char
            return '&#xFFFD;';
        }

        return $this->replaceAttrDefined($chr);
    }

    protected function charIsUndefinedInHtml($chr)
    {
        $ord = ord($chr);
        return ($ord <= 0x1f && $chr != "\t" && $chr != "\n" && $chr != "\r")
              || ($ord >= 0x7f && $ord <= 0x9f);
    }

    protected function replaceAttrDefined($chr)
    {
        $ord = $this->getUtf16Ord($chr);

        // is this a mapped entity?
        if (isset($this->entities[$ord])) {
            return $this->entities[$ord];
        }

        // is this an upper-range hex entity?
        if ($ord > 255) {
            return sprintf('&#x%04X;', $ord);
        }
        
        // everything else
        return sprintf('&#x%02X;', $ord);
    }

    protected function getUtf16Ord($chr)
    {
        // convert UTF-8 to UTF-16BE
        if (strlen($chr) > 1) {
            $chr = $this->convert($chr, 'UTF-8', 'UTF-16BE');
        }
        return hexdec(bin2hex($chr));
    }

}
