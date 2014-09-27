<?php
namespace Aura\Html\_Config;

use Aura\Di\_Config\AbstractContainerTest;

class CommonTest extends AbstractContainerTest
{
    protected function getConfigClasses()
    {
        return array(
            'Aura\Html\_Config\Common',
        );
    }

    public function provideGet()
    {
        return array(
            array('aura/html:escaper', 'Aura\Html\Escaper'),
            array('aura/html:helper', 'Aura\Html\HelperLocator'),
        );
    }

    public function provideNewInstance()
    {
        return array(
            array('Aura\Html\Escaper'),
            array('Aura\Html\HelperLocator'),
            array('Aura\Html\Helper\Input'),
        );
    }
}
