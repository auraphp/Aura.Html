<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 *
 */
namespace Aura\Html\Helper;

/**
 *
 * Helper for a stack of <script> tags.
 *
 * @package Aura.Html
 *
 */
class Scripts extends AbstractSeries
{
    private $capture;

    /**
     *
     * Adds a <script> tag to the stack.
     *
     * @param string $src The source href for the script.
     *
     * @param int $pos The script position in the stack.
     *
     * @return null
     *
     */
    public function add($src, $pos = 100)
    {
        $attr = $this->escaper->attr(array(
            'src' => $src,
            'type' => 'text/javascript',
        ));
        $tag = "<script $attr></script>";
        $this->addElement($pos, $tag);

        return $this;
    }

    /**
     *
     * Adds a <script> tag to the stack with additional attributes
     *
     * @param string $src The source href for the script.
     *
     * @param string $attr The additional attributes
     *
     * @param int $pos The script position in the stack.
     *
     * @return null
     *
     */
    public function addAttr($src, array $attr = null, $pos = 100)
    {
        $attr = (array) $attr;

        $base = array(
            'src' => $src,
            'type' => 'text/javascript',
        );

        unset($attr['src']);
        unset($attr['type']);

        $attr = $this->escaper->attr(array_merge($base, $attr));

        $tag = "<script $attr></script>";
        $this->addElement($pos, $tag);

        return $this;
    }

    /**
     *
     * Adds a conditional `<!--[if ...]><script><![endif] -->` tag to the
     * stack.
     *
     * @param string $cond The conditional expression for the script.
     *
     * @param string $src The source href for the script.
     *
     * @param string $pos The script position in the stack.
     *
     * @return null
     *
     */
    public function addCond($cond, $src, $pos = 100)
    {
        $cond = $this->escaper->html($cond);
        $attr = $this->escaper->attr(array(
            'src' => $src,
            'type' => 'text/javascript',
        ));
        $tag = "<!--[if $cond]><script $attr></script><![endif]-->";
        $this->addElement($pos, $tag);

        return $this;
    }

    /**
     * Adds internal script
     *
     * @param mixed $script The script
     * @param int   $pos    The script position in the stack.
     *
     * @return Scripts
     *
     * @access public
     */
    public function addInternal($script, $pos = 100)
    {
        $attr = $this->escaper->attr(array(
            'type' => 'text/javascript'
        ));
        $tag = "<script $attr>$script</script>";
        $this->addElement($pos, $tag);
        return $this;
    }

    /**
     * addCondInternal
     *
     * @param mixed $cond   The conditional expression for the script.
     * @param mixed $script The script
     * @param int   $pos    The script position in the stack.
     *
     * @return mixed
     * @throws exceptionclass [description]
     *
     * @access public
     */
    public function addCondInternal($cond, $script, $pos = 100)
    {
        $cond = $this->escaper->html($cond);
        $attr = $this->escaper->attr(array(
            'type' => 'text/javascript',
        ));
        $tag = "<!--[if $cond]><script $attr>$script</script><![endif]-->";
        $this->addElement($pos, $tag);

        return $this;
    }

    /**
     * Adds internal script
     *
     * @param int $pos The script position in the stack.
     *
     * @return Scripts
     *
     * @access public
     */
    public function beginInternal($pos = 100)
    {
        $this->capture[] = $pos;
         ob_start();
    }

    /**
     * beginInternalCond
     *
     * @param mixed $cond DESCRIPTION
     * @param int   $pos  DESCRIPTION
     *
     * @return mixed
     *
     * @access public
     */
    public function beginCondInternal($cond, $pos = 100)
    {
        $this->capture[] = array($cond, $pos);
        ob_start();
    }

    /**
     * endInternal
     *
     * @return mixed
     *
     * @access public
     */
    public function endInternal()
    {
        $script = ob_get_clean();
        $params = array_pop($this->capture);
        if (is_array($params)) {
            return $this->addCondInternal(
                $params[0],
                $script,
                $params[1]
            );
        }
        return $this->addInternal($script, $params);
    }
}
