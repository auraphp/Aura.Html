<?php
$di->params['Aura\Html\HelperLocator']['helper_factory'] = $di->lazyNew('Aura\Html\HelperFactory');
$di->params['Aura\Html\HelperFactory']['escaper'] = $di->lazyNew('Aura\Html\Escaper');
$di->params['Aura\Html\HelperFactory']['registry'] = array(
    'anchor' => $di->lazyNew('Aura\Html\Helper\Anchor'),
    'attr' => $di->lazyNew('Aura\Html\Helper\EscapeAttr'),
    'base' => $di->lazyNew('Aura\Html\Helper\Base'),
    'form' => $di->lazyNew('Aura\Html\Helper\Form'),
    'escapeHtml' => $di->lazyNew('Aura\Html\Helper\EscapeHtml'),
    'img' => $di->lazyNew('Aura\Html\Helper\Img'),
    // input needs to be implemented
    'links' => $di->lazyNew('Aura\Html\Helper\Links'),
    'metas' => $di->lazyNew('Aura\Html\Helper\Metas'),
    'ol' => $di->lazyNew('Aura\Html\Helper\Ol'),
    'scripts' => $di->lazyNew('Aura\Html\Helper\Scripts'),
    'scriptsFoot' => $di->lazyNew('Aura\Html\Helper\Scripts'),
    'styles' => $di->lazyNew('Aura\Html\Helper\Styles'),
    'tag' => $di->lazyNew('Aura\Html\Helper\Tag'),
    'title' => $di->lazyNew('Aura\Html\Helper\Title'),
    'ul' => $di->lazyNew('Aura\Html\Helper\Ul'),
);
