<?php
namespace Aura\Html\Functions;

use Aura\Html\Escaper;
use Aura\Html\Exception;

class EscaperFunctions
{
    protected static $escaper;

    public static function setEscaper(Escaper $escaper)
    {
        static::$escaper = $escaper;
    }

    public static function attr($raw)
    {
        return static::$escaper->attr($raw);
    }

    public static function html($raw)
    {
        return static::$escaper->html($raw);
    }
    
    public static function css($raw)
    {
        return static::$escaper->css($raw);
    }
    
    public static function js($raw)
    {
        return static::$escaper->js($raw);
    }
}

function a($str)
{
    return EscaperFunctions::attr($str);
}

function c($str)
{
    return EscaperFunctions::css($str);
}

function j($str)
{
    return EscaperFunctions::js($str);
}

function h($str)
{
    return EscaperFunctions::html($str);
}
