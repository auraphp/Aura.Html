<?php
namespace Aura\Html\Escaper;

class HtmlEscaper extends AbstractEscaper
{
    /**
     * 
     * Flags for `htmlspecialchars()`.
     *
     * @var mixed
     * 
     */
    protected $flags = ENT_QUOTES;

    public function __construct($flags = null, $encoding = null)
    {
        if ($flags !== null) {
            // use custom flags only
            $this->setFlags($flags);
        } elseif (defined('ENT_SUBSTITUTE')) {
            // add ENT_SUBSTITUTE if available (PHP 5.4)
            $this->setFlags(ENT_QUOTES | ENT_SUBSTITUTE);
        }
        
        parent::__construct($encoding);
    }

    public function __invoke($raw)
    {
        // pre-empt escaping
        if ($raw === '' || ctype_digit($raw)) {
            return $raw;
        }

        // return the escaped string
        return htmlspecialchars(
            $raw, 
            $this->flags,
            $this->encoding
        );
    }

    /**
     * 
     * Sets the flags for `htmlspecialchars()`.
     * 
     * @param mixed $flags The flags.
     * 
     * @return null
     * 
     */
    public function setFlags($flags)
    {
        $this->flags = $flags;
    }
    
    /**
     * 
     * Gets the flags for `htmlspecialchars()`.
     * 
     * @return mixed
     * 
     */
    public function getFlags()
    {
        return $this->flags;
    }
    
}
