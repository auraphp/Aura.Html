<?php
namespace Aura\Html\_Config;

use Aura\Di\ContainerAssertionsTrait;

class CommonTest extends \PHPUnit_Framework_TestCase
{
    use ContainerAssertionsTrait;

    public function setUp()
    {
        $this->setUpContainer(array(
            'Aura\Html\_Config\Common',
        ));
    }

    public function test()
    {
        $this->assertGet('aura/html:escaper', 'Aura\Html\Escaper');
        $this->assertGet('aura/html:helper', 'Aura\Html\HelperLocator');
        $this->assertNewInstance('Aura\Html\Escaper');
        $this->assertNewInstance('Aura\Html\HelperLocator');
        $this->assertNewInstance('Aura\Html\Helper\Input');
    }
}
