<?php
namespace Aura\Html\Escaper;

use Aura\Html\Exeption;

class CssEscaper extends AbstractEscaper
{
    public function __invoke($raw)
    {
        return $this->replace(
            $raw,
            '/[^a-z0-9]/iSu'
        );
    }

    /**
     * 
     * Replaces unsafe JavaScript attribute characters.
     *
     * @param array $matches Matches from preg_replace_callback().
     * 
     * @return string Escaped characters.
     * 
     */
    protected function replaceMatches($matches)
    {
        // get the character
        $chr = $matches[0];
        
        // is it UTF-8?
        if (strlen($chr) == 1) {
            // yes
            $ord = ord($chr);
        } else {
            // no
            $chr = $this->convert($chr, 'UTF-8', 'UTF-16BE');
            $ord = hexdec(bin2hex($chr));
        }
        
        // done
        return sprintf('\\%X ', $ord);
    }

}
